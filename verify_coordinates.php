<?php

use Illuminate\Support\Facades\DB;

// Verificar coordenadas de algunas organizaciones
$orgs = DB::table('organizaciones')
    ->select('id', 'nombre', 'ubi_Lat', 'ubi_long', 'provincia_id', 'canton_id', 'distrito_id')
    ->whereNotNull('ubi_Lat')
    ->get();

echo "=== VERIFICACIÓN DE COORDENADAS EN BASE DE DATOS ===\n\n";

foreach ($orgs as $org) {
    echo "ID: {$org->id}\n";
    echo "Nombre: {$org->nombre}\n";
    echo "Latitud (raw): {$org->ubi_Lat}\n";
    echo "Longitud (raw): {$org->ubi_long}\n";
    echo "Latitud (float): " . (float) $org->ubi_Lat . "\n";
    echo "Longitud (float): " . (float) $org->ubi_long . "\n";
    echo "Provincia: {$org->provincia_id}, Cantón: {$org->canton_id}, Distrito: {$org->distrito_id}\n";
    echo "---\n\n";
}

echo "\n=== COORDENADAS ESPERADAS vs REALES ===\n\n";

$expected = [
    'Municipalidad de San José' => ['lat' => '9.933333', 'long' => '-84.083333'],
    'Municipalidad de Santa Cruz' => ['lat' => '10.251667', 'long' => '-85.685278'],
    'Municipalidad de Cartago' => ['lat' => '9.862500', 'long' => '-83.919444'],
];

foreach ($expected as $nombre => $coords) {
    $org = DB::table('organizaciones')->where('nombre', 'LIKE', "%{$nombre}%")->first();
    if ($org) {
        echo "{$nombre}:\n";
        echo "  Esperado -> Lat: {$coords['lat']}, Long: {$coords['long']}\n";
        echo "  Real     -> Lat: {$org->ubi_Lat}, Long: {$org->ubi_long}\n";
        $latDiff = abs((float)$coords['lat'] - (float)$org->ubi_Lat);
        $longDiff = abs((float)$coords['long'] - (float)$org->ubi_long);
        echo "  Diferencia -> Lat: {$latDiff}, Long: {$longDiff}\n\n";
    }
}
