<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Organizacion;
use App\Models\TipoOrganizacion;
use App\Models\Provincia;
use App\Models\Canton;
use App\Models\Distrito;
use App\Models\User;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Organizacion>
 */
class OrganizacionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $provincia = Provincia::factory()->create();
        $canton = Canton::factory()->create(['provincia_id' => $provincia->id]);
        $distrito = Distrito::factory()->create(['canton_id' => $canton->id]);

        return [
        'ced_juridica' => $this->faker->unique()->numerify('#########'),
        'nombre' => $this->faker->company,
        'tipo_id' => TipoOrganizacion::factory(),
        'telefono' => $this->faker->phoneNumber,
        'correo' => $this->faker->unique()->safeEmail,
        'urlPageWeb' => $this->faker->url,
        'provincia_id' => $provincia->id,
        'canton_id' => $canton->id,
        'distrito_id' => $distrito->id,
        'ubi_Lat' => $this->faker->latitude,
        'ubi_long' => $this->faker->longitude,
        'urlDirectorioTelefonico' => $this->faker->url,
        'user_id' => User::factory(),
        ];
    }
}
