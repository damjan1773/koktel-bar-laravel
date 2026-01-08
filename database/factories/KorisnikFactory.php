<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class KorisnikFactory extends Factory
{
    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'table' => fake()->word(),
            'ime' => fake()->word(),
            'prezime' => fake()->word(),
            'uloga' => fake()->word(),
        ];
    }
}
