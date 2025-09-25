<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\TipoOrganizacion;

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
            TipoOrganizacion::create(['nombre' => $tipo]);
        }
    }
}
