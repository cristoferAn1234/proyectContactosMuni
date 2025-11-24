<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Provincia;
class ProvinciasSeeder extends Seeder
{
    
    public function run(): void
    {
      $provincias = [
            ['id' => 1, 'nombre' => 'San José'],
            ['id' => 2, 'nombre' => 'Alajuela'],
            ['id' => 3, 'nombre' => 'Heredia'],
            ['id' => 4, 'nombre' => 'Cartago'],
            ['id' => 5, 'nombre' => 'Guanacaste'],
            ['id' => 6, 'nombre' => 'Puntarenas'],
            ['id' => 7, 'nombre' => 'Limón'],
        ];

        Provincia::insert($provincias);
    }
}
