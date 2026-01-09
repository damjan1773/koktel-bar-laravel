<x-app-layout>
    <div class="max-w-xl mx-auto p-6">
        <h1 class="text-2xl font-bold mb-4">Porudzbina je poslata barmenu</h1>

        <div class="border p-4 rounded">
            <p><b>Broj porudzbine:</b> {{ $porudzbina->id }}</p>
            <p><b>Sto:</b> {{ $porudzbina->broj_stola }}</p>
            <p><b>Status:</b> {{ $porudzbina->status }}</p>
        </div>

        <div class="mt-6 flex gap-3">
            <a class="border px-4 py-2" href="{{ route('konobar.porudzbine.create') }}">Nova porudzbina</a>
            <a class="border px-4 py-2" href="{{ route('konobar.porudzbine.index') }}">Vidi porudzbine</a>
        </div>
    </div>
</x-app-layout>
