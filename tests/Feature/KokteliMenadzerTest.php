<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class KokteliMenadzerTest extends TestCase
{
    use RefreshDatabase;

    public function test_menadzer_moze_da_vidi_listu_koktela(): void
    {
        $menadzer = User::factory()->create([
            'role' => 'menadzer',
        ]);

        $response = $this->actingAs($menadzer)->get('/koktels');

        $response->assertStatus(200);
    }

    public function test_neulogovan_korisnik_se_redirektuje_sa_koktels(): void
    {
        $response = $this->get('/koktels');

        $response->assertRedirect('/login');
    }
}
