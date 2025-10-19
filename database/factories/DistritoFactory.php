<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Distrito>
 */
class DistritoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'id' => $this->faker->unique()->numberBetween(10101, 70605),
            'nombre' => $this->faker->word(),
          //  'canton_id' => $this->faker->numberBetween(101, 706), 
        ];
    }
}
