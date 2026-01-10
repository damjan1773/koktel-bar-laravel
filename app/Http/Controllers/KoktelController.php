<?php

namespace App\Http\Controllers;

use App\Http\Requests\KoktelStoreRequest;
use App\Http\Requests\KoktelUpdateRequest;
use App\Models\Koktel;
use Illuminate\Http\Request;

class KoktelController extends Controller
{
    public function index()
    {
        $kokteli = \App\Models\Koktel::all();

        return view('koktel.index', compact('kokteli'));
        
    }

    public function create(Request $request)
    {
        return view('koktel.create');
    }

    public function store(KoktelStoreRequest $request)
    {
        $koktel = Koktel::create($request->validated());

        $request->session()->flash('koktel.id', $koktel->id);

        return redirect()->route('koktels.index');
    }

    public function show(Request $request, Koktel $koktel)
    {
        return view('koktel.show', [
            'koktel' => $koktel,
        ]);
    }

    public function edit(Request $request, Koktel $koktel)
    {
        return view('koktel.edit', [
            'koktel' => $koktel,
        ]);
    }

    public function update(KoktelUpdateRequest $request, Koktel $koktel)
    {
        $koktel->update($request->validated());

        $request->session()->flash('koktel.id', $koktel->id);

        return redirect()->route('koktels.index');
    }

    public function destroy(Request $request, Koktel $koktel)
    {
        $koktel->delete();

        return redirect()->route('koktels.index');
    }
}
