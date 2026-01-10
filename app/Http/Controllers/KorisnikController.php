<?php

namespace App\Http\Controllers;

use App\Http\Requests\KorisnikStoreRequest;
use App\Http\Requests\KorisnikUpdateRequest;
use App\Models\Korisnik;
use Illuminate\Http\Request;

class KorisnikController extends Controller
{
    public function index(Request $request)
    {
        $korisniks = Korisnik::all();

        return view('korisnik.index', [
            'korisniks' => $korisniks,
        ]);
    }

    public function create(Request $request)
    {
        return view('korisnik.create');
    }

    public function store(KorisnikStoreRequest $request)
    {
        $korisnik = Korisnik::create($request->validated());

        $request->session()->flash('korisnik.id', $korisnik->id);

        return redirect()->route('korisniks.index');
    }

    public function show(Request $request, Korisnik $korisnik)
    {
        return view('korisnik.show', [
            'korisnik' => $korisnik,
        ]);
    }

    public function edit(Request $request, Korisnik $korisnik)
    {
        return view('korisnik.edit', [
            'korisnik' => $korisnik,
        ]);
    }

    public function update(KorisnikUpdateRequest $request, Korisnik $korisnik)
    {
        $korisnik->update($request->validated());

        $request->session()->flash('korisnik.id', $korisnik->id);

        return redirect()->route('korisniks.index');
    }

    public function destroy(Request $request, Korisnik $korisnik)
    {
        $korisnik->delete();

        return redirect()->route('korisniks.index');
    }
}
