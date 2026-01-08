<?php

namespace Database\Seeders;

use App\Models\Porudzbina;
use Illuminate\Database\Seeder;

class PorudzbinaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Porudzbina::factory()->count(5)->create();
    }
}
