<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Verificar si ya existe un usuario administrador
        $adminExists = User::where('email', 'admin@contactosmuni.com')->first();
        
        if (!$adminExists) {
            User::create([
                'name' => 'Administrador Sistema',
                'email' => 'admin@contactosmuni.com',
                'password' => Hash::make('Admin123!'), // Cambiar esta contraseña en producción
                'role' => 'admin',
                'aprobado' => 'aprobado',
                'email_verified_at' => now(),
            ]);

            $this->command->info('✅ Usuario administrador creado exitosamente.');
            $this->command->info('📧 Email: admin@contactosmuni.com');
            $this->command->info('🔑 Password: Admin123!');
            $this->command->warn('⚠️  IMPORTANTE: Cambiar la contraseña después del primer inicio de sesión.');
        } else {
            $this->command->warn('⚠️  El usuario administrador ya existe.');
        }
    }
}
