<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use PHPUnit\Framework\Attributes\Test;
use App\Models\Puesto;
use App\Models\Organizacion;

class ContactosMuniTest extends TestCase
{
    use RefreshDatabase;
    #[Test]
 public function storeContacto()
 {
    $user = \App\Models\User::factory()->create();
    $puesto = Puesto::factory()->create();
    $organizacion = Organizacion::factory()->create();
    $data = [
        'nombre' => 'Juan',
        'apellido1' => 'Pérez',
        'apellido2' => 'Gómez',
        'sexo' => 'Masculino',
        'puesto' => 'Alcalde',
        'puesto_id' => $puesto->id,
        'departamento' => 'Alcaldía',
        'formacion' => 'Licenciatura en Administración',
        'extension' => '1234',
        'email_institucional' => 'juan.perez@ejemplo.com',
        'organizacion_id' => $organizacion->id,
        'activo' => true,
        'nivel_contacto' => '1',
        'created_by' => $user->id,
        'updated_by' => $user->id,
    ];

     $response = $this->postJson('/contactos', $data);

     $response->assertStatus(201);
     $this->assertDatabaseHas('contactos', $data);
 }
}
