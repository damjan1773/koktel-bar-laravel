<?php

namespace App\Http\Controllers;

use App\Http\Requests\PorudzbinaStoreRequest;
use App\Http\Requests\PorudzbinaUpdateRequest;
use App\Models\Koktel;
use App\Models\Porudzbina;
use App\Models\StavkaPorudzbine;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

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
        return view('menadzer.porudzbina-edit', compact('porudzbina'));
    }

    public function update(Request $request, Porudzbina $porudzbina)
    {
        $request->validate([
            'broj_stola' => 'required|integer|min:1',
            'status' => 'required|in:u_pripremi,spremno,isporucena',
        ]);

        $porudzbina->update([
            'broj_stola' => $request->broj_stola,
            'status' => $request->status,
        ]);

        return redirect()
            ->route('menadzer.porudzbine.index')
            ->with('success', 'Porudžbina izmenjena');
    }

    public function destroy(Request $request, Porudzbina $porudzbina)
    {
        $porudzbina->delete();

        return redirect()->route('porudzbinas.index');
    }

    public function konobarIndex(): \Illuminate\View\View
    {
        $userId = Auth::id();

        $uPripremi = Porudzbina::with('stavkaPorudzbines.koktel')
            ->where('korisnik_id', $userId)
            ->where('status', 'u_pripremi')
            ->latest()
            ->get();

        $spremne = Porudzbina::with('stavkaPorudzbines.koktel')
            ->where('korisnik_id', $userId)
            ->where('status', 'spremno')
            ->latest()
            ->get();

        return view('porudzbina.index', compact('uPripremi', 'spremne'));
    }

    public function konobarCreate()
    {
        $kokteli = \App\Models\Koktel::orderBy('naziv')->get();

        return view('porudzbina.create', compact('kokteli'));
    }

    public function konobarStore(Request $request)
    {
        $data = $request->validate([
            'broj_stola' => ['required', 'integer', 'min:1'],
            'napomena' => ['nullable', 'string', 'max:1000'],
            'stavke' => ['required', 'array', 'min:1'],
            'stavke.*.koktel_id' => ['required', 'exists:koktels,id'],
            'stavke.*.kolicina' => ['required', 'integer', 'min:1'],
        ]);

        $porudzbina = Porudzbina::create([
            'broj_stola' => $data['broj_stola'],
            'status' => 'u_pripremi',
            'napomena' => $data['napomena'] ?? null,
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

    public function konobarIsporuceno(\App\Models\Porudzbina $porudzbina): \Illuminate\Http\RedirectResponse
    {
        if ($porudzbina->korisnik_id !== Auth::id()) {
            abort(403);
        }

        if ($porudzbina->status === 'spremno') {
            $porudzbina->update(['status' => 'isporucena']);
        }

        return redirect()->route('konobar.porudzbine.index');
    }

    public function sankerIndex(): View
    {
        $uPripremi = Porudzbina::with('stavkaPorudzbines.koktel')
            ->where('status', 'u_pripremi')
            ->latest()
            ->get();

        $spremne = Porudzbina::with('stavkaPorudzbines.koktel')
            ->where('status', 'spremno')
            ->latest()
            ->get();

        return view('sanker.porudzbine', compact('uPripremi', 'spremne'));
    }

    public function sankerSpremno(Porudzbina $porudzbina): RedirectResponse
    {
        if ($porudzbina->status === 'u_pripremi') {
            $porudzbina->update(['status' => 'spremno']);
        }

        return redirect()->route('sanker.porudzbine.index');
    }

    public function menadzerIndex()
    {
        $porudzbine = Porudzbina::with(['stavkaPorudzbines.koktel'])
            ->latest()
            ->get();

        return view('menadzer.porudzbine', compact('porudzbine'));
    }

    public function menadzerEdit(Porudzbina $porudzbina)
    {
        $porudzbina->load('stavkaPorudzbines.koktel');
        $kokteli = Koktel::orderBy('naziv')->get();

        return view('menadzer.porudzbina-edit', compact('porudzbina', 'kokteli'));
    }

    public function menadzerUpdate(Request $request, Porudzbina $porudzbina)
    {
        $data = $request->validate([
            'broj_stola' => ['required','integer','min:1'],
            'status' => ['required','string'],
            'stavke' => ['required','array','min:1'],
            'stavke.*.koktel_id' => ['required','exists:koktels,id'],
            'stavke.*.kolicina' => ['required','integer','min:1'],
        ]);

        
        $porudzbina->update([
            'broj_stola' => $data['broj_stola'],
            'status' => $data['status'],
        ]);

        
        $porudzbina->stavkaPorudzbines()->delete();

        foreach ($data['stavke'] as $s) {
            $koktel = \App\Models\Koktel::findOrFail($s['koktel_id']);

            $porudzbina->stavkaPorudzbines()->create([
                'koktel_id' => $koktel->id,
                'kolicina' => $s['kolicina'],
                'jedinicna_cena' => $koktel->cena,
            ]);
        }

        return redirect()->route('menadzer.porudzbine.index')
            ->with('success', 'Porudžbina je izmenjena.');
    }

    public function menadzerDestroy(Porudzbina $porudzbina)
    {
        
        $porudzbina->stavkaPorudzbines()->delete();

        $porudzbina->delete();

        return redirect()->route('menadzer.porudzbine.index')
            ->with('success', 'Porudzbina obrisana.');
    }

}
