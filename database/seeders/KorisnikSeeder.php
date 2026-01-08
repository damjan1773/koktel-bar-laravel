<?php

namespace Database\Seeders;

use App\Models\Korisnik;
use Illuminate\Database\Seeder;

class KorisnikSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Korisnik::factory()->count(5)->create();
    }
}
