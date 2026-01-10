<?php

namespace Database\Seeders;

use App\Models\Sastojak;
use Illuminate\Database\Seeder;

class SastojakSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            ['naziv' => 'Led',   'kolicina' => 5000, 'jedinica' => 'g'],
            ['naziv' => 'Votka', 'kolicina' => 3000, 'jedinica' => 'ml'],
            ['naziv' => 'Viski', 'kolicina' => 2000, 'jedinica' => 'ml'],
            ['naziv' => 'Rum',   'kolicina' => 2000, 'jedinica' => 'ml'],
            ['naziv' => 'Limeta','kolicina' => 30,   'jedinica' => 'kom'],
        ];

        foreach ($data as $row) {
            Sastojak::create($row);
        }
    }
}
