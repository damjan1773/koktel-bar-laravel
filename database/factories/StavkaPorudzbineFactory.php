<?php

namespace Database\Factories;

use App\Models\Koktel;
use App\Models\Porudzbina;
use Illuminate\Database\Eloquent\Factories\Factory;

class StavkaPorudzbineFactory extends Factory
{
    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'porudzbina_id' => Porudzbina::factory(),
            'koktel_id' => Koktel::factory(),
            'kolicina' => fake()->numberBetween(-10000, 10000),
            'jedinicna_cena' => fake()->randomFloat(0, 0, 9999999999.),
        ];
    }
}
