<x-app-layout>
<form method="POST" action="{{ route('konobar.porudzbine.store') }}">
    @csrf

    <div class="mb-4">
        <label>Broj stola</label>
        <input name="broj_stola" type="number" min="1" required class="border p-2 w-full">
    </div>

    <div class="mb-4">
        <label>Koktel</label>
        <select name="stavke[0][koktel_id]" class="border p-2 w-full" required>
            @foreach ($kokteli as $k)
                <option value="{{ $k->id }}">{{ $k->naziv }} ({{ $k->cena }})</option>
            @endforeach
        </select>
    </div>

    <div class="mb-4">
        <label>Kolicina</label>
        <input name="stavke[0][kolicina]" type="number" min="1" value="1" required class="border p-2 w-full">
    </div>

    <button class="border px-4 py-2">Sacuvaj</button>
</form>
</x-app-layout>
