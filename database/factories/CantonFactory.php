<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Canton>
 */
class CantonFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'id' => $this->faker->unique()->numberBetween(101, 706),
            'nombre' => $this->faker->word(),
           // 'provincia_id' => $this->faker->numberBetween(1, 7),
        ];
    }
}
