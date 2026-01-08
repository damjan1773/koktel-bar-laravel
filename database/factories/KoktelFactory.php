<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class KoktelFactory extends Factory
{
    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'table' => fake()->word(),
            'naziv' => fake()->word(),
            'cena' => fake()->randomFloat(0, 0, 9999999999.),
            'opis' => fake()->text(),
        ];
    }
}
