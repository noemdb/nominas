<?php

namespace App\Traits;

use Illuminate\Support\Facades\Log;

trait Loggable
{
    /**
     * Registra una acción en el log de la aplicación
     *
     * @param string $action La acción realizada
     * @param array $data Datos adicionales para el log
     * @param string $level Nivel del log (info, warning, error, etc.)
     * @return void
     */
    protected function logAction(string $action, array $data = [], string $level = 'info'): void
    {
        $logData = [
            'action' => $action,
            'user_id' => auth()->id(),
            'user_name' => auth()->user()?->name,
            'model' => class_basename($this),
            'data' => $data,
            'ip' => request()->ip(),
            'user_agent' => request()->userAgent(),
        ];

        Log::channel('application')->$level(json_encode($logData));
    }

    /**
     * Registra una acción de creación
     *
     * @param array $data Datos del modelo creado
     * @return void
     */
    protected function logCreation(array $data = []): void
    {
        $this->logAction('create', $data);
    }

    /**
     * Registra una acción de actualización
     *
     * @param array $oldData Datos anteriores
     * @param array $newData Datos nuevos
     * @return void
     */
    protected function logUpdate(array $oldData = [], array $newData = []): void
    {
        $this->logAction('update', [
            'old_data' => $oldData,
            'new_data' => $newData,
        ]);
    }

    /**
     * Registra una acción de eliminación
     *
     * @param array $data Datos del modelo eliminado
     * @return void
     */
    protected function logDeletion(array $data = []): void
    {
        $this->logAction('delete', $data);
    }

    /**
     * Registra un error
     *
     * @param string $message Mensaje de error
     * @param array $context Contexto adicional
     * @return void
     */
    protected function logError(string $message, array $context = []): void
    {
        $this->logAction('error', array_merge(['message' => $message], $context), 'error');
    }
}