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
            ['nombre' => 'San José'],
            ['nombre' => 'Alajuela'],
            ['nombre' => 'Cartago'],
            ['nombre' => 'Heredia'],
            ['nombre' => 'Guanacaste'],
            ['nombre' => 'Puntarenas'],
            ['nombre' => 'Limón'],
        ];

        Provincia::insert($provincias);
    }
}
