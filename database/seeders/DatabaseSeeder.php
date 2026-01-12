<?php

namespace Database\Seeders;

use App\Models\Koktel;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        User::updateOrCreate(
            ['email' => 'test@example.com'],
            [
                'name' => 'Test User',
                'password' => Hash::make('password'),
            ]
        );

        User::updateOrCreate(
            ['email' => 'konobar@test.com'],
            ['name' => 'Konobar', 'password' => Hash::make('password'), 'uloga' => 'konobar']
        );

        User::updateOrCreate(
            ['email' => 'sanker@test.com'],
            ['name' => 'Sanker', 'password' => Hash::make('password'), 'uloga' => 'sanker']
        );

        User::updateOrCreate(
            ['email' => 'menadzer@test.com'],
            ['name' => 'Menadzer', 'password' => Hash::make('password'), 'uloga' => 'menadzer']
        );

        Koktel::updateOrCreate(
            ['naziv' => 'Mojito'],
            ['cena' => 900, 'opis' => 'Rum, menta, limeta']
        );

        Koktel::updateOrCreate(
            ['naziv' => 'Martini'],
            ['cena' => 1100, 'opis' => 'Džin, vermut']
        );

        Koktel::updateOrCreate(
            ['naziv' => 'Whiskey Sour'],
            ['cena' => 1200, 'opis' => 'Viski, limun']
        );

        $this->call([
            KorisnikSeeder::class,
            KoktelSeeder::class,
            SastojakSeeder::class,
        ]);


    }
}
