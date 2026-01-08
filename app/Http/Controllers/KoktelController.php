<?php

namespace App\Http\Controllers;

use App\Http\Requests\KoktelStoreRequest;
use App\Http\Requests\KoktelUpdateRequest;
use App\Models\Koktel;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class KoktelController extends Controller
{
    public function index(Request $request): Response
    {
        $koktels = Koktel::all();

        return view('koktel.index', [
            'koktels' => $koktels,
        ]);
    }

    public function create(Request $request): Response
    {
        return view('koktel.create');
    }

    public function store(KoktelStoreRequest $request): Response
    {
        $koktel = Koktel::create($request->validated());

        $request->session()->flash('koktel.id', $koktel->id);

        return redirect()->route('koktels.index');
    }

    public function show(Request $request, Koktel $koktel): Response
    {
        return view('koktel.show', [
            'koktel' => $koktel,
        ]);
    }

    public function edit(Request $request, Koktel $koktel): Response
    {
        return view('koktel.edit', [
            'koktel' => $koktel,
        ]);
    }

    public function update(KoktelUpdateRequest $request, Koktel $koktel): Response
    {
        $koktel->update($request->validated());

        $request->session()->flash('koktel.id', $koktel->id);

        return redirect()->route('koktels.index');
    }

    public function destroy(Request $request, Koktel $koktel): Response
    {
        $koktel->delete();

        return redirect()->route('koktels.index');
    }
}
