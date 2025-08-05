<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Log;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $adminRole = Role::where('name', 'admin')->first();
        if (!$adminRole) {
            $this->command->error('El rol "admin" no fue encontrado. Asegúrate de ejecutar RoleSeeder primero.');
            Log::error('Seeder Abortado: El rol "admin" no fue encontrado.');
            return;
        }
        $adminEmail = env('ADMIN_EMAIL', 'admin@example.com');
        $adminPassword = env('ADMIN_PASSWORD', 'password');
        $adminUser = User::firstOrCreate(
            ['email' => $adminEmail],
            [
                'name' => env('ADMIN_NAME', 'Admin User'),
                'password' => Hash::make($adminPassword),
                'email_verified_at' => now(),
                'telefono' => env('ADMIN_PHONE', '5555555555'),
            ]
        );
        $adminUser->roles()->syncWithoutDetaching([$adminRole->id]);

        $this->command->info('Usuario administrador creado o ya existente.');
        $this->command->info("Email: " . $adminEmail);
        $this->command->warn("Contraseña: " . $adminPassword . " (¡Cámbiala en producción!)");

    }
}
