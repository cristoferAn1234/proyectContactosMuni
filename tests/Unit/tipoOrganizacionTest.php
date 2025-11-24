<?php

namespace Tests\Unit;

use App\Models\TipoOrganizacion;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use PHPUnit\Framework\Attributes\Test;

class TipoOrganizacionTest extends TestCase
{
    use RefreshDatabase;
    #[Test]
     public function store_tipo_organizacion()
     {
     $data = [
         'nombre' => 'ONG'
     ];
     $response = $this->post('/tiposOrganizacion', $data);
     $response->assertStatus(201);
     $this->assertDatabaseHas('tiposOrganizacion', $data);
     }

}
