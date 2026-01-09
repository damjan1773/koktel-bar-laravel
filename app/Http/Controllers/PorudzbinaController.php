<?php

namespace App\Http\Controllers;

use App\Http\Requests\PorudzbinaStoreRequest;
use App\Http\Requests\PorudzbinaUpdateRequest;
use App\Models\Porudzbina;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\Koktel;
use App\Models\StavkaPorudzbine;
use Illuminate\Support\Facades\Auth;



class PorudzbinaController extends Controller
{
    public function index(Request $request)
    {
        $porudzbinas = Porudzbina::all();

        return view('porudzbina.index', [
            'porudzbinas' => $porudzbinas,
        ]);
    }

    public function create(Request $request)
    {
        return view('porudzbina.create');
    }

    public function store(PorudzbinaStoreRequest $request)
    {
        $porudzbina = Porudzbina::create($request->validated());

        $request->session()->flash('porudzbina.id', $porudzbina->id);

        return redirect()->route('porudzbinas.index');
    }

    public function show(Request $request, Porudzbina $porudzbina)
    {
        return view('porudzbina.show', [
            'porudzbina' => $porudzbina,
        ]);
    }

    public function edit(Request $request, Porudzbina $porudzbina)
    {
        return view('porudzbina.edit', [
            'porudzbina' => $porudzbina,
        ]);
    }

    public function update(PorudzbinaUpdateRequest $request, Porudzbina $porudzbina)
    {
        $porudzbina->update($request->validated());

        $request->session()->flash('porudzbina.id', $porudzbina->id);

        return redirect()->route('porudzbinas.index');
    }

    public function destroy(Request $request, Porudzbina $porudzbina)
    {
        $porudzbina->delete();

        return redirect()->route('porudzbinas.index');
    }

    public function konobarIndex()
{
    $porudzbine = Porudzbina::where('korisnik_id', Auth::id())
        ->latest()
        ->get();

    return view('porudzbina.index', ['porudzbinas' => $porudzbine]);
}

public function konobarCreate()
{
    $kokteli = \App\Models\Koktel::orderBy('naziv')->get();
    
    return view('porudzbina.create', compact('kokteli'));
}

public function konobarStore(Request $request)
{
    $data = $request->validate([
        'broj_stola' => ['required','integer','min:1'],
        'stavke' => ['required','array','min:1'],
        'stavke.*.koktel_id' => ['required','exists:koktels,id'],
        'stavke.*.kolicina' => ['required','integer','min:1'],
    ]);

    $porudzbina = Porudzbina::create([
        'broj_stola' => $data['broj_stola'],
        'status' => 'u_pripremi',
        'napomena' => null,
        'korisnik_id' => Auth::id(),
    ]);

    foreach ($data['stavke'] as $stavka) {
        $koktel = Koktel::findOrFail($stavka['koktel_id']);

        StavkaPorudzbine::create([
            'porudzbina_id' => $porudzbina->id,
            'koktel_id' => $koktel->id,
            'kolicina' => $stavka['kolicina'],
            'jedinicna_cena' => $koktel->cena,
        ]);
    }

    return redirect()->route('konobar.porudzbine.sent', $porudzbina);
}

public function konobarSent(Porudzbina $porudzbina)
{
    return view('porudzbina.sent', compact('porudzbina'));
}

public function sankerIndex()
{
    $porudzbine = \App\Models\Porudzbina::with('stavkaPorudzbines.koktel')
        ->where('status', 'u_pripremi')
        ->latest()
        ->get();

    return view('sanker.porudzbine', compact('porudzbine'));
}

public function sankerSpremno(\App\Models\Porudzbina $porudzbina)
{
    if ($porudzbina->status === 'u_pripremi') {
        $porudzbina->update(['status' => 'spremno']);
    }

    return redirect()->route('sanker.porudzbine.index');
}



}
