<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

class BackupDatabase extends Command
{
    protected $signature = 'backup:database {--type=all : Tipo de backup (all, database, files)}';
    protected $description = 'Realiza un backup de la base de datos y/o archivos';

    public function handle()
    {
        $type = $this->option('type');
        $timestamp = Carbon::now()->format('Y-m-d_H-i-s');
        $backupPath = storage_path('app/backups');

        // Crear directorio de backups si no existe
        if (!file_exists($backupPath)) {
            mkdir($backupPath, 0755, true);
        }

        try {
            if ($type === 'all' || $type === 'database') {
                $this->backupDatabase($timestamp);
            }

            if ($type === 'all' || $type === 'files') {
                $this->backupFiles($timestamp);
            }

            $this->cleanOldBackups();
            $this->info('Backup completado exitosamente.');
        } catch (\Exception $e) {
            Log::error('Error al realizar backup: ' . $e->getMessage());
            $this->error('Error al realizar backup: ' . $e->getMessage());
        }
    }

    protected function backupDatabase($timestamp)
    {
        $filename = "database_backup_{$timestamp}.sql";
        $path = storage_path("app/backups/{$filename}");

        $command = sprintf(
            'mysqldump -u%s -p%s %s > %s',
            config('database.connections.mysql.username'),
            config('database.connections.mysql.password'),
            config('database.connections.mysql.database'),
            $path
        );

        exec($command, $output, $returnVar);

        if ($returnVar !== 0) {
            throw new \Exception('Error al realizar backup de la base de datos');
        }

        $this->info("Backup de base de datos guardado en: {$filename}");
    }

    protected function backupFiles($timestamp)
    {
        $filename = "files_backup_{$timestamp}.zip";
        $path = storage_path("app/backups/{$filename}");

        $zip = new \ZipArchive();
        if ($zip->open($path, \ZipArchive::CREATE | \ZipArchive::OVERWRITE) === true) {
            // Agregar archivos de storage
            $this->addFolderToZip(storage_path('app/public'), $zip, 'storage');

            // Agregar archivos de uploads si existen
            if (file_exists(public_path('uploads'))) {
                $this->addFolderToZip(public_path('uploads'), $zip, 'uploads');
            }

            $zip->close();
            $this->info("Backup de archivos guardado en: {$filename}");
        } else {
            throw new \Exception('Error al crear el archivo ZIP');
        }
    }

    protected function addFolderToZip($folder, $zip, $relativePath)
    {
        $files = new \RecursiveIteratorIterator(
            new \RecursiveDirectoryIterator($folder),
            \RecursiveIteratorIterator::LEAVES_ONLY
        );

        foreach ($files as $file) {
            if (!$file->isDir()) {
                $filePath = $file->getRealPath();
                $relativeFilePath = $relativePath . '/' . substr($filePath, strlen($folder) + 1);
                $zip->addFile($filePath, $relativeFilePath);
            }
        }
    }

    protected function cleanOldBackups()
    {
        $backupPath = storage_path('app/backups');
        $files = glob($backupPath . '/*');
        $now = time();

        // Mantener backups de los últimos 30 días
        foreach ($files as $file) {
            if (is_file($file)) {
                if ($now - filemtime($file) >= 30 * 24 * 60 * 60) {
                    unlink($file);
                }
            }
        }
    }
}