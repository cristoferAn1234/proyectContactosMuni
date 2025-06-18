<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Tipo;

class TiposSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tipos = [
            'Gobierno Local',
            'Cooperativa',
            'Institucion Pública',
            'Consorcio',
            'ONG'
        ];

        foreach ($tipos as $tipo) {
            Tipo::create(['nombre' => $tipo]);
        }
    }
}
