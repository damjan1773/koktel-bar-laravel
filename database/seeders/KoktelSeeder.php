<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Koktel;

class KoktelSeeder extends Seeder
{
    public function run(): void
    {
        $kokteli = [
            ['naziv' => 'Mojito', 'cena' => 750],
            ['naziv' => 'Margarita', 'cena' => 800],
            ['naziv' => 'Old Fashioned', 'cena' => 900],
            ['naziv' => 'Negroni', 'cena' => 850],
            ['naziv' => 'Daiquiri', 'cena' => 750],
            ['naziv' => 'Whiskey Sour', 'cena' => 800],
            ['naziv' => 'Cosmopolitan', 'cena' => 780],
            ['naziv' => 'Pina Colada', 'cena' => 820],
            ['naziv' => 'Espresso Martini', 'cena' => 950],
            ['naziv' => 'Long Island Iced Tea', 'cena' => 1000],
        ];

        foreach ($kokteli as $k) {
            Koktel::firstOrCreate(
                ['naziv' => $k['naziv']], 
                ['cena' => $k['cena']]
            );
        }
    }
}
