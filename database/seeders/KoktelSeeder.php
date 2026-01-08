<?php

namespace Database\Seeders;

use App\Models\Koktel;
use Illuminate\Database\Seeder;

class KoktelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Koktel::factory()->count(5)->create();
    }
}
