<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Koktel;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\KoktelController
 */
final class KoktelControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    #[Test]
    public function index_displays_view(): void
    {
        $koktels = Koktel::factory()->count(3)->create();

        $response = $this->get(route('koktels.index'));

        $response->assertOk();
        $response->assertViewIs('koktel.index');
        $response->assertViewHas('koktels', $koktels);
    }


    #[Test]
    public function create_displays_view(): void
    {
        $response = $this->get(route('koktels.create'));

        $response->assertOk();
        $response->assertViewIs('koktel.create');
    }


    #[Test]
    public function store_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\KoktelController::class,
            'store',
            \App\Http\Requests\KoktelControllerStoreRequest::class
        );
    }

    #[Test]
    public function store_saves_and_redirects(): void
    {
        $table = fake()->word();
        $naziv = fake()->word();
        $cena = fake()->randomFloat(/** decimal_attributes **/);

        $response = $this->post(route('koktels.store'), [
            'table' => $table,
            'naziv' => $naziv,
            'cena' => $cena,
        ]);

        $koktels = Koktel::query()
            ->where('table', $table)
            ->where('naziv', $naziv)
            ->where('cena', $cena)
            ->get();
        $this->assertCount(1, $koktels);
        $koktel = $koktels->first();

        $response->assertRedirect(route('koktels.index'));
        $response->assertSessionHas('koktel.id', $koktel->id);
    }


    #[Test]
    public function show_displays_view(): void
    {
        $koktel = Koktel::factory()->create();

        $response = $this->get(route('koktels.show', $koktel));

        $response->assertOk();
        $response->assertViewIs('koktel.show');
        $response->assertViewHas('koktel', $koktel);
    }


    #[Test]
    public function edit_displays_view(): void
    {
        $koktel = Koktel::factory()->create();

        $response = $this->get(route('koktels.edit', $koktel));

        $response->assertOk();
        $response->assertViewIs('koktel.edit');
        $response->assertViewHas('koktel', $koktel);
    }


    #[Test]
    public function update_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\KoktelController::class,
            'update',
            \App\Http\Requests\KoktelControllerUpdateRequest::class
        );
    }

    #[Test]
    public function update_redirects(): void
    {
        $koktel = Koktel::factory()->create();
        $table = fake()->word();
        $naziv = fake()->word();
        $cena = fake()->randomFloat(/** decimal_attributes **/);

        $response = $this->put(route('koktels.update', $koktel), [
            'table' => $table,
            'naziv' => $naziv,
            'cena' => $cena,
        ]);

        $koktel->refresh();

        $response->assertRedirect(route('koktels.index'));
        $response->assertSessionHas('koktel.id', $koktel->id);

        $this->assertEquals($table, $koktel->table);
        $this->assertEquals($naziv, $koktel->naziv);
        $this->assertEquals($cena, $koktel->cena);
    }


    #[Test]
    public function destroy_deletes_and_redirects(): void
    {
        $koktel = Koktel::factory()->create();

        $response = $this->delete(route('koktels.destroy', $koktel));

        $response->assertRedirect(route('koktels.index'));

        $this->assertModelMissing($koktel);
    }
}
