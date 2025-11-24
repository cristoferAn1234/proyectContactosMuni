<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use PHPUnit\Framework\Attributes\Test;
class OrganizacionesTest extends TestCase
{
       use RefreshDatabase;
    #[Test]
    public function test_example(){
     $provincia = \App\Models\Provincia::factory()->create();
     $canton = \App\Models\Canton::factory()->create(['provincia_id' => $provincia->id]);
     $distrito = \App\Models\Distrito::factory()->create(['canton_id' => $canton->id]);
     $tipo = \App\Models\TipoOrganizacion::factory()->create();
     $user = \App\Models\User::factory()->create();
        $data = [
            'ced_juridica' => '123456789',
            'nombre' => 'Municipalidad de Test',
            'tipo_id' => $tipo->id,
            'telefono' => '12345678',
            'correo' => 'info@municipalidadtest.com',
            'urlPageWeb' => 'http://municipalidadtest.com',
            'provincia_id' => $provincia->id,
            'canton_id' => $canton->id,
            'distrito_id' => $distrito->id,
            'ubi_lat' => '-0.123456',
            'ubi_long' => '-78.123456',
            'urlDirectorioTelefonico' => 'http://municipalidadtest.com/directorio',
            'user_id' => $user->id,
        ];
           $response = $this->postJson('/organizaciones', $data);

        $response->assertStatus(201);
    }


     

}
