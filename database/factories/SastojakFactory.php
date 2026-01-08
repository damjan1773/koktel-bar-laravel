<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class SastojakFactory extends Factory
{
    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'naziv' => fake()->word(),
            'kolicina' => fake()->randomFloat(0, 0, 9999999999.),
            'jedinica' => fake()->word(),
        ];
    }
}
