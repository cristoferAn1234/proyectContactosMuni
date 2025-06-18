<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Puesto;

class PuestosSeeder extends Seeder
{
  
    public function run(): void
    {
        $puestos = [ 'Alcaldía',
            'Secretaría de Alcaldía',
            'Gestión Ambiental',
            'Unidad Técnica de Gestión Vial',
            'Recursos Humanos','Secretario',
            'Gestión de Proyectos',
        ]
        ;
        foreach ($puestos as $puesto) {
            Puesto::create(['nombre' => $puesto]);
        }
    }
}
