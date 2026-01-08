<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class PorudzbinaFactory extends Factory
{
    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'broj_stola' => fake()->numberBetween(-10000, 10000),
            'status' => fake()->word(),
            'napomena' => fake()->text(),
            'korisnik_id' => User::factory(),
        ];
    }
}
