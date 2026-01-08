<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Sastojak;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\SastojakController
 */
final class SastojakControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    #[Test]
    public function index_displays_view(): void
    {
        $sastojaks = Sastojak::factory()->count(3)->create();

        $response = $this->get(route('sastojaks.index'));

        $response->assertOk();
        $response->assertViewIs('sastojak.index');
        $response->assertViewHas('sastojaks', $sastojaks);
    }


    #[Test]
    public function create_displays_view(): void
    {
        $response = $this->get(route('sastojaks.create'));

        $response->assertOk();
        $response->assertViewIs('sastojak.create');
    }


    #[Test]
    public function store_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\SastojakController::class,
            'store',
            \App\Http\Requests\SastojakControllerStoreRequest::class
        );
    }

    #[Test]
    public function store_saves_and_redirects(): void
    {
        $table = fake()->word();
        $naziv = fake()->word();
        $kolicina = fake()->randomFloat(/** decimal_attributes **/);
        $jedinica = fake()->word();

        $response = $this->post(route('sastojaks.store'), [
            'table' => $table,
            'naziv' => $naziv,
            'kolicina' => $kolicina,
            'jedinica' => $jedinica,
        ]);

        $sastojaks = Sastojak::query()
            ->where('table', $table)
            ->where('naziv', $naziv)
            ->where('kolicina', $kolicina)
            ->where('jedinica', $jedinica)
            ->get();
        $this->assertCount(1, $sastojaks);
        $sastojak = $sastojaks->first();

        $response->assertRedirect(route('sastojaks.index'));
        $response->assertSessionHas('sastojak.id', $sastojak->id);
    }


    #[Test]
    public function show_displays_view(): void
    {
        $sastojak = Sastojak::factory()->create();

        $response = $this->get(route('sastojaks.show', $sastojak));

        $response->assertOk();
        $response->assertViewIs('sastojak.show');
        $response->assertViewHas('sastojak', $sastojak);
    }


    #[Test]
    public function edit_displays_view(): void
    {
        $sastojak = Sastojak::factory()->create();

        $response = $this->get(route('sastojaks.edit', $sastojak));

        $response->assertOk();
        $response->assertViewIs('sastojak.edit');
        $response->assertViewHas('sastojak', $sastojak);
    }


    #[Test]
    public function update_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\SastojakController::class,
            'update',
            \App\Http\Requests\SastojakControllerUpdateRequest::class
        );
    }

    #[Test]
    public function update_redirects(): void
    {
        $sastojak = Sastojak::factory()->create();
        $table = fake()->word();
        $naziv = fake()->word();
        $kolicina = fake()->randomFloat(/** decimal_attributes **/);
        $jedinica = fake()->word();

        $response = $this->put(route('sastojaks.update', $sastojak), [
            'table' => $table,
            'naziv' => $naziv,
            'kolicina' => $kolicina,
            'jedinica' => $jedinica,
        ]);

        $sastojak->refresh();

        $response->assertRedirect(route('sastojaks.index'));
        $response->assertSessionHas('sastojak.id', $sastojak->id);

        $this->assertEquals($table, $sastojak->table);
        $this->assertEquals($naziv, $sastojak->naziv);
        $this->assertEquals($kolicina, $sastojak->kolicina);
        $this->assertEquals($jedinica, $sastojak->jedinica);
    }


    #[Test]
    public function destroy_deletes_and_redirects(): void
    {
        $sastojak = Sastojak::factory()->create();

        $response = $this->delete(route('sastojaks.destroy', $sastojak));

        $response->assertRedirect(route('sastojaks.index'));

        $this->assertModelMissing($sastojak);
    }
}
