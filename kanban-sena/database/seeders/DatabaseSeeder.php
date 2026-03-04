<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Admin
        User::create([
            'name' => 'SENA Admin',
            'email' => 'admin@sena.edu.co',
            'password' => Hash::make('password'),
            'role' => 'admin',
        ]);

        // Coordinador
        User::create([
            'name' => 'SENA Coordinador',
            'email' => 'coordinador@sena.edu.co',
            'password' => Hash::make('password'),
            'role' => 'coordinador',
        ]);

        // Instructor
        User::create([
            'name' => 'SENA Instructor',
            'email' => 'instructor@sena.edu.co',
            'password' => Hash::make('password'),
            'role' => 'instructor',
        ]);

        // Aprendiz
        User::create([
            'name' => 'SENA Aprendiz',
            'email' => 'aprendiz@sena.edu.co',
            'password' => Hash::make('password'),
            'role' => 'aprendiz',
        ]);
    }
}
