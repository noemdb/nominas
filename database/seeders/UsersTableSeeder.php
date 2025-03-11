<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UsersTableSeeder extends Seeder
{
    public function run()
    {       

        User::create([
            'name' => 'Admin User',
            'username' => 'admin',
            'email' => 'admin@example.com',
            'password' => Hash::make('admin'), // Cambia la contraseña por seguridad
            'email_verified_at' => now(),
            'remember_token' => Str::random(10),
        ]);

        User::create([
            'name' => 'Profesor por Horas',
            'username' => 'noemdb',
            'email' => 'noemdb@example.com',
            'password' => Hash::make('noemdb'), // Cambia la contraseña por seguridad
            'email_verified_at' => now(),
            'remember_token' => Str::random(10),
        ]);

        User::factory(30)->create();

    }
}
