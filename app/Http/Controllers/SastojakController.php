<?php

namespace App\Http\Controllers;

use App\Http\Requests\SastojakStoreRequest;
use App\Http\Requests\SastojakUpdateRequest;
use App\Models\Sastojak;
use Illuminate\Http\Request;

class SastojakController extends Controller
{
    public function index()
    {
        $sastojci = \App\Models\Sastojak::all();

        return view('sastojak.index', compact('sastojci'));
    }

    public function create(Request $request)
    {
        return view('sastojak.create');
    }

    public function store(SastojakStoreRequest $request)
    {
        $sastojak = Sastojak::create($request->validated());

        $request->session()->flash('sastojak.id', $sastojak->id);

        return redirect()->route('sastojaks.index');
    }

    public function show(Request $request, Sastojak $sastojak)
    {
        return view('sastojak.show', [
            'sastojak' => $sastojak,
        ]);
    }

    public function edit(Request $request, Sastojak $sastojak)
    {
        return view('sastojak.edit', [
            'sastojak' => $sastojak,
        ]);
    }

    public function update(SastojakUpdateRequest $request, Sastojak $sastojak)
    {
        $sastojak->update($request->validated());

        $request->session()->flash('sastojak.id', $sastojak->id);

        return redirect()->route('sastojaks.index');
    }

    public function destroy(Request $request, Sastojak $sastojak)
    {
        $sastojak->delete();

        return redirect()->route('sastojaks.index');
    }
}
