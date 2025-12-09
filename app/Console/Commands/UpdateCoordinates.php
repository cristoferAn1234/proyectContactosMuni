<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class UpdateCoordinates extends Command
{
    protected $signature = 'coordinates:update';
    protected $description = 'Actualizar coordenadas de organizaciones a valores correctos';

    public function handle()
    {
        $this->info('Actualizando coordenadas...');

        // Coordenadas correctas para organizaciones de prueba en Costa Rica
        $updates = [
            // San José centro
            ['pattern' => 'San José', 'lat' => '9.933333', 'long' => '-84.083333', 'nombre' => 'San José'],
            
            // Santa Cruz, Guanacaste - 10° 15' 06" N, 85° 41' 07" W
            ['pattern' => 'Santa Cruz', 'lat' => '10.251667', 'long' => '-85.685278', 'nombre' => 'Santa Cruz'],
            
            // MEP en San José
            ['pattern' => 'MEP', 'lat' => '9.935556', 'long' => '-84.084444', 'nombre' => 'MEP'],
            
            // CCSS en San José
            ['pattern' => 'CCSS', 'lat' => '9.937778', 'long' => '-84.081111', 'nombre' => 'CCSS'],
            
            // ICE en San José
            ['pattern' => 'ICE', 'lat' => '9.940000', 'long' => '-84.082222', 'nombre' => 'ICE'],
        ];

        foreach ($updates as $update) {
            $affected = DB::table('organizaciones')
                ->where('nombre', 'LIKE', '%' . $update['pattern'] . '%')
                ->update([
                    'ubi_Lat' => $update['lat'],
                    'ubi_long' => $update['long']
                ]);
            
            if ($affected > 0) {
                $this->info("✓ {$update['nombre']}: {$update['lat']}, {$update['long']} ({$affected} registros)");
            } else {
                $this->warn("✗ {$update['nombre']}: No se encontraron registros");
            }
        }

        $this->newLine();
        $this->info('Verificando resultados...');
        
        $orgs = DB::table('organizaciones')
            ->whereNotNull('ubi_Lat')
            ->select('nombre', 'ubi_Lat', 'ubi_long')
            ->get();

        foreach ($orgs as $org) {
            $this->line("{$org->nombre}: Lat {$org->ubi_Lat}, Long {$org->ubi_long}");
        }

        $this->newLine();
        $this->info('¡Coordenadas actualizadas correctamente!');
        
        return 0;
    }
}
