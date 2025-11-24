<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
   
    public function run(): void
    {
        // Crear usuario administrador primero
        $this->call(AdminUserSeeder::class);
        
        // Datos geográficos y catálogos
        $this->call(ProvinciasSeeder::class);
        $this->call(PuestosSeeder::class);
        $this->call(TiposSeeder::class);
        $this->call(CantonesSeeder::class);
        $this->call(DistritosSeeder::class);
        
        // Usuario de prueba (comentado para evitar duplicados)
        // User::factory()->create([
        //     'name' => 'Cristofer',
        //     'email' => 'crisangulo123@gmail.com',
        //     'password' => bcrypt('12345678'),
        // ]);
    }
}
