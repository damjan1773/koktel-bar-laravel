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
        Sastojak::factory()->count(5)->create();
    }
}
