<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Korisnik;
use App\Models\Porudzbina;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\PorudzbinaController
 */
final class PorudzbinaControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    #[Test]
    public function index_displays_view(): void
    {
        $porudzbinas = Porudzbina::factory()->count(3)->create();

        $response = $this->get(route('porudzbinas.index'));

        $response->assertOk();
        $response->assertViewIs('porudzbina.index');
        $response->assertViewHas('porudzbinas', $porudzbinas);
    }


    #[Test]
    public function create_displays_view(): void
    {
        $response = $this->get(route('porudzbinas.create'));

        $response->assertOk();
        $response->assertViewIs('porudzbina.create');
    }


    #[Test]
    public function store_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\PorudzbinaController::class,
            'store',
            \App\Http\Requests\PorudzbinaControllerStoreRequest::class
        );
    }

    #[Test]
    public function store_saves_and_redirects(): void
    {
        $broj_stola = fake()->numberBetween(-10000, 10000);
        $status = fake()->word();
        $korisnik = Korisnik::factory()->create();

        $response = $this->post(route('porudzbinas.store'), [
            'broj_stola' => $broj_stola,
            'status' => $status,
            'korisnik_id' => $korisnik->id,
        ]);

        $porudzbinas = Porudzbina::query()
            ->where('broj_stola', $broj_stola)
            ->where('status', $status)
            ->where('korisnik_id', $korisnik->id)
            ->get();
        $this->assertCount(1, $porudzbinas);
        $porudzbina = $porudzbinas->first();

        $response->assertRedirect(route('porudzbinas.index'));
        $response->assertSessionHas('porudzbina.id', $porudzbina->id);
    }


    #[Test]
    public function show_displays_view(): void
    {
        $porudzbina = Porudzbina::factory()->create();

        $response = $this->get(route('porudzbinas.show', $porudzbina));

        $response->assertOk();
        $response->assertViewIs('porudzbina.show');
        $response->assertViewHas('porudzbina', $porudzbina);
    }


    #[Test]
    public function edit_displays_view(): void
    {
        $porudzbina = Porudzbina::factory()->create();

        $response = $this->get(route('porudzbinas.edit', $porudzbina));

        $response->assertOk();
        $response->assertViewIs('porudzbina.edit');
        $response->assertViewHas('porudzbina', $porudzbina);
    }


    #[Test]
    public function update_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\PorudzbinaController::class,
            'update',
            \App\Http\Requests\PorudzbinaControllerUpdateRequest::class
        );
    }

    #[Test]
    public function update_redirects(): void
    {
        $porudzbina = Porudzbina::factory()->create();
        $broj_stola = fake()->numberBetween(-10000, 10000);
        $status = fake()->word();
        $korisnik = Korisnik::factory()->create();

        $response = $this->put(route('porudzbinas.update', $porudzbina), [
            'broj_stola' => $broj_stola,
            'status' => $status,
            'korisnik_id' => $korisnik->id,
        ]);

        $porudzbina->refresh();

        $response->assertRedirect(route('porudzbinas.index'));
        $response->assertSessionHas('porudzbina.id', $porudzbina->id);

        $this->assertEquals($broj_stola, $porudzbina->broj_stola);
        $this->assertEquals($status, $porudzbina->status);
        $this->assertEquals($korisnik->id, $porudzbina->korisnik_id);
    }


    #[Test]
    public function destroy_deletes_and_redirects(): void
    {
        $porudzbina = Porudzbina::factory()->create();

        $response = $this->delete(route('porudzbinas.destroy', $porudzbina));

        $response->assertRedirect(route('porudzbinas.index'));

        $this->assertModelMissing($porudzbina);
    }
}
