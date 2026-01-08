<?php

namespace App\Http\Controllers;

use App\Http\Requests\KorisnikStoreRequest;
use App\Http\Requests\KorisnikUpdateRequest;
use App\Models\Korisnik;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class KorisnikController extends Controller
{
    public function index(Request $request): Response
    {
        $korisniks = Korisnik::all();

        return view('korisnik.index', [
            'korisniks' => $korisniks,
        ]);
    }

    public function create(Request $request): Response
    {
        return view('korisnik.create');
    }

    public function store(KorisnikStoreRequest $request): Response
    {
        $korisnik = Korisnik::create($request->validated());

        $request->session()->flash('korisnik.id', $korisnik->id);

        return redirect()->route('korisniks.index');
    }

    public function show(Request $request, Korisnik $korisnik): Response
    {
        return view('korisnik.show', [
            'korisnik' => $korisnik,
        ]);
    }

    public function edit(Request $request, Korisnik $korisnik): Response
    {
        return view('korisnik.edit', [
            'korisnik' => $korisnik,
        ]);
    }

    public function update(KorisnikUpdateRequest $request, Korisnik $korisnik): Response
    {
        $korisnik->update($request->validated());

        $request->session()->flash('korisnik.id', $korisnik->id);

        return redirect()->route('korisniks.index');
    }

    public function destroy(Request $request, Korisnik $korisnik): Response
    {
        $korisnik->delete();

        return redirect()->route('korisniks.index');
    }
}
