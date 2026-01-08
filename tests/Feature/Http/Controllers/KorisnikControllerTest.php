<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Korisnik;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\KorisnikController
 */
final class KorisnikControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    #[Test]
    public function index_displays_view(): void
    {
        $korisniks = Korisnik::factory()->count(3)->create();

        $response = $this->get(route('korisniks.index'));

        $response->assertOk();
        $response->assertViewIs('korisnik.index');
        $response->assertViewHas('korisniks', $korisniks);
    }


    #[Test]
    public function create_displays_view(): void
    {
        $response = $this->get(route('korisniks.create'));

        $response->assertOk();
        $response->assertViewIs('korisnik.create');
    }


    #[Test]
    public function store_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\KorisnikController::class,
            'store',
            \App\Http\Requests\KorisnikControllerStoreRequest::class
        );
    }

    #[Test]
    public function store_saves_and_redirects(): void
    {
        $table = fake()->word();
        $ime = fake()->word();
        $prezime = fake()->word();
        $uloga = fake()->word();

        $response = $this->post(route('korisniks.store'), [
            'table' => $table,
            'ime' => $ime,
            'prezime' => $prezime,
            'uloga' => $uloga,
        ]);

        $korisniks = Korisnik::query()
            ->where('table', $table)
            ->where('ime', $ime)
            ->where('prezime', $prezime)
            ->where('uloga', $uloga)
            ->get();
        $this->assertCount(1, $korisniks);
        $korisnik = $korisniks->first();

        $response->assertRedirect(route('korisniks.index'));
        $response->assertSessionHas('korisnik.id', $korisnik->id);
    }


    #[Test]
    public function show_displays_view(): void
    {
        $korisnik = Korisnik::factory()->create();

        $response = $this->get(route('korisniks.show', $korisnik));

        $response->assertOk();
        $response->assertViewIs('korisnik.show');
        $response->assertViewHas('korisnik', $korisnik);
    }


    #[Test]
    public function edit_displays_view(): void
    {
        $korisnik = Korisnik::factory()->create();

        $response = $this->get(route('korisniks.edit', $korisnik));

        $response->assertOk();
        $response->assertViewIs('korisnik.edit');
        $response->assertViewHas('korisnik', $korisnik);
    }


    #[Test]
    public function update_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\KorisnikController::class,
            'update',
            \App\Http\Requests\KorisnikControllerUpdateRequest::class
        );
    }

    #[Test]
    public function update_redirects(): void
    {
        $korisnik = Korisnik::factory()->create();
        $table = fake()->word();
        $ime = fake()->word();
        $prezime = fake()->word();
        $uloga = fake()->word();

        $response = $this->put(route('korisniks.update', $korisnik), [
            'table' => $table,
            'ime' => $ime,
            'prezime' => $prezime,
            'uloga' => $uloga,
        ]);

        $korisnik->refresh();

        $response->assertRedirect(route('korisniks.index'));
        $response->assertSessionHas('korisnik.id', $korisnik->id);

        $this->assertEquals($table, $korisnik->table);
        $this->assertEquals($ime, $korisnik->ime);
        $this->assertEquals($prezime, $korisnik->prezime);
        $this->assertEquals($uloga, $korisnik->uloga);
    }


    #[Test]
    public function destroy_deletes_and_redirects(): void
    {
        $korisnik = Korisnik::factory()->create();

        $response = $this->delete(route('korisniks.destroy', $korisnik));

        $response->assertRedirect(route('korisniks.index'));

        $this->assertModelMissing($korisnik);
    }
}
