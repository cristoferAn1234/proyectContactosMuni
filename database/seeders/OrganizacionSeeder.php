<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Organizacion;
use App\Models\Provincia;
use App\Models\Canton;
use App\Models\Distrito;
use App\Models\TipoOrganizacion;
use App\Models\User;

class OrganizacionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Obtener datos necesarios para las relaciones
        $provincia = Provincia::first();
        $canton = Canton::first();
        $distrito = Distrito::first();
        $tipo = TipoOrganizacion::first();
        $user = User::where('role', 'admin')->first();

        // Crear 3 organizaciones de prueba
        $organizaciones = [
            [
                'ced_juridica' => 3101123456,
                'nombre' => 'Municipalidad de San José',
                'tipo_id' => $tipo->id ?? 1,
                'telefono' => '2547-6000',
                'correo' => 'info@msj.go.cr',
                'urlPageWeb' => 'https://www.msj.go.cr',
                'provincia_id' => $provincia->id ?? 1,
                'canton_id' => $canton->id ?? 1,
                'distrito_id' => $distrito->id ?? 1,
                'ubi_lat' => '9.933333',
                'ubi_long' => '-84.083333',
                'urlDirectorioTelefonico' => 'https://www.msj.go.cr/directorio',
                'user_id' => $user->id ?? 1,
            ],
            [
                'ced_juridica' => 3101234567,
                'nombre' => 'Ministerio de Educación Pública',
                'tipo_id' => $tipo->id ?? 1,
                'telefono' => '2547-5000',
                'correo' => 'info@mep.go.cr',
                'urlPageWeb' => 'https://www.mep.go.cr',
                'provincia_id' => $provincia->id ?? 1,
                'canton_id' => $canton->id ?? 1,
                'distrito_id' => $distrito->id ?? 1,
                'ubi_lat' => '9.935556',
                'ubi_long' => '-84.084444',
                'urlDirectorioTelefonico' => 'https://www.mep.go.cr/directorio',
                'user_id' => $user->id ?? 1,
            ],
            [
                'ced_juridica' => 3101345678,
                'nombre' => 'Caja Costarricense de Seguro Social',
                'tipo_id' => $tipo->id ?? 1,
                'telefono' => '2547-4000',
                'correo' => 'consultas@ccss.sa.cr',
                'urlPageWeb' => 'https://www.ccss.sa.cr',
                'provincia_id' => $provincia->id ?? 1,
                'canton_id' => $canton->id ?? 1,
                'distrito_id' => $distrito->id ?? 1,
                'ubi_lat' => '9.937778',
                'ubi_long' => '-84.081111',
                'urlDirectorioTelefonico' => 'https://www.ccss.sa.cr/directorio',
                'user_id' => $user->id ?? 1,
            ],
        ];

        foreach ($organizaciones as $org) {
            Organizacion::create($org);
        }

        $this->command->info('✓ 3 organizaciones de prueba creadas exitosamente.');
    }
}
