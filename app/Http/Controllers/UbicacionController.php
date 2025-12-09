<?php

namespace App\Http\Controllers;

use App\Models\Organizacion;
use Illuminate\Http\Request;

class UbicacionController extends Controller
{
    /**
     * Mostrar el mapa de ubicaciones
     */
    public function index()
    {
        return view('ubicacion.index');
    }

    /**
     * Buscar organizaciones según término de búsqueda
     */
    public function search(Request $request)
    {
        try {
            $query = $request->input('q', '');
            
            if (empty($query)) {
                // Si no hay búsqueda, retornar todas las organizaciones con coordenadas
                $organizaciones = Organizacion::with(['tipo', 'provincia', 'canton', 'distrito'])
                    ->whereNotNull('ubi_Lat')
                    ->whereNotNull('ubi_long')
                    ->get();
            } else {
                // Buscar por nombre de organización o tipo
                $organizaciones = Organizacion::with(['tipo', 'provincia', 'canton', 'distrito'])
                    ->whereNotNull('ubi_Lat')
                    ->whereNotNull('ubi_long')
                    ->where(function($q) use ($query) {
                        $q->where('nombre', 'LIKE', '%' . $query . '%')
                          ->orWhereHas('tipo', function($subQ) use ($query) {
                              $subQ->where('nombre', 'LIKE', '%' . $query . '%');
                          });
                    })
                    ->get();
            }

            // Log para debugging
            \Log::info('Ubicación - Búsqueda: ' . $query . ' - Resultados: ' . $organizaciones->count());

            // DEBUG: Ver los datos crudos
            $firstOrg = $organizaciones->first();
            if ($firstOrg) {
                \Log::info('DEBUG Organización:', [
                    'nombre' => $firstOrg->nombre,
                    'ubi_Lat_raw' => $firstOrg->ubi_Lat,
                    'ubi_long_raw' => $firstOrg->ubi_long,
                    'ubi_Lat_float' => (float) $firstOrg->ubi_Lat,
                    'ubi_long_float' => (float) $firstOrg->ubi_long,
                    'attributes' => $firstOrg->getAttributes()
                ]);
            }

            // Formatear datos para el mapa
            // Mapbox usa [longitude, latitude] en setLngLat
            $markers = $organizaciones->map(function($org) {
                return [
                    'longitude' => (float) $org->ubi_long,  // Longitud (Este-Oeste) -85 para CR
                    'latitude' => (float) $org->ubi_Lat,    // Latitud (Norte-Sur) 10 para CR - ¡Nota la L mayúscula!
                    'label' => $org->nombre,
                    'tooltip' => $this->buildTooltip($org),
                    'color' => $this->getMarkerColor($org->tipo->nombre ?? 'default')
                ];
            });

            return response()->json([
                'success' => true,
                'count' => $organizaciones->count(),
                'markers' => $markers
            ]);
        } catch (\Exception $e) {
            \Log::error('Error en búsqueda de ubicaciones: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'error' => 'Error al buscar organizaciones',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Construir tooltip HTML para cada marcador
     */
    private function buildTooltip($organizacion)
    {
        $tipo = $organizacion->tipo->nombre ?? 'N/A';
        $provincia = $organizacion->provincia->nombre ?? 'N/A';
        $canton = $organizacion->canton->nombre ?? 'N/A';
        $telefono = $organizacion->telefono ?? 'N/A';
        $correo = $organizacion->correo ?? 'N/A';
        
        return "<div style='min-width: 200px;'>
                    <strong style='color: #00ADED; font-size: 14px;'>{$organizacion->nombre}</strong><br>
                    <small style='color: #666;'>
                        <strong>Tipo:</strong> {$tipo}<br>
                        <strong>Ubicación:</strong> {$provincia}, {$canton}<br>
                        <strong>Teléfono:</strong> {$telefono}<br>
                        <strong>Correo:</strong> {$correo}
                    </small>
                </div>";
    }

    /**
     * Obtener color del marcador según tipo de organización
     */
    private function getMarkerColor($tipo)
    {
        $colores = [
            'Municipalidad' => '#00ADED',      // Azul cyan
            'Gobierno Local' => '#00ADED',
            'Institución Pública' => '#f84d4d', // Rojo
            'Cooperativa' => '#4CAF50',         // Verde
            'Consorcio' => '#FF9800',           // Naranja
            'ONG' => '#9C27B0',                 // Púrpura
            'default' => '#808080'              // Gris
        ];

        foreach ($colores as $key => $color) {
            if (stripos($tipo, $key) !== false) {
                return $color;
            }
        }

        return $colores['default'];
    }
}
