<?php

namespace App\Http\Controllers;

use App\Http\Requests\PorudzbinaStoreRequest;
use App\Http\Requests\PorudzbinaUpdateRequest;
use App\Models\Porudzbina;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PorudzbinaController extends Controller
{
    public function index(Request $request): Response
    {
        $porudzbinas = Porudzbina::all();

        return view('porudzbina.index', [
            'porudzbinas' => $porudzbinas,
        ]);
    }

    public function create(Request $request): Response
    {
        return view('porudzbina.create');
    }

    public function store(PorudzbinaStoreRequest $request): Response
    {
        $porudzbina = Porudzbina::create($request->validated());

        $request->session()->flash('porudzbina.id', $porudzbina->id);

        return redirect()->route('porudzbinas.index');
    }

    public function show(Request $request, Porudzbina $porudzbina): Response
    {
        return view('porudzbina.show', [
            'porudzbina' => $porudzbina,
        ]);
    }

    public function edit(Request $request, Porudzbina $porudzbina): Response
    {
        return view('porudzbina.edit', [
            'porudzbina' => $porudzbina,
        ]);
    }

    public function update(PorudzbinaUpdateRequest $request, Porudzbina $porudzbina): Response
    {
        $porudzbina->update($request->validated());

        $request->session()->flash('porudzbina.id', $porudzbina->id);

        return redirect()->route('porudzbinas.index');
    }

    public function destroy(Request $request, Porudzbina $porudzbina): Response
    {
        $porudzbina->delete();

        return redirect()->route('porudzbinas.index');
    }
}
