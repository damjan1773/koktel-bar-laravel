<x-app-layout>
    <div class="max-w-4xl mx-auto p-6 space-y-6">
        <h1 class="text-2xl font-bold">Izmena porudzbine #{{ $porudzbina->id }}</h1>

        <form method="POST" action="{{ route('menadzer.porudzbine.update', $porudzbina) }}" class="space-y-6">
            @csrf
            @method('PUT')

            <div>
                <label class="block text-sm mb-1">Broj stola</label>
                <input name="broj_stola" class="w-full border rounded px-3 py-2"
                       value="{{ old('broj_stola', $porudzbina->broj_stola) }}">
                @error('broj_stola') <div class="text-red-600 text-sm">{{ $message }}</div> @enderror
            </div>

            <div>
                <label class="block text-sm mb-1">Status</label>
                <select name="status" class="w-full border rounded px-3 py-2">
                    @foreach(['u_pripremi','spremno','isporucena','otkazana'] as $st)
                        <option value="{{ $st }}" @selected(old('status', $porudzbina->status) === $st)>
                            {{ $st }}
                        </option>
                    @endforeach
                </select>
                @error('status') <div class="text-red-600 text-sm">{{ $message }}</div> @enderror
            </div>

            <div class="space-y-3">
                <div class="flex items-center justify-between">
                    <h2 class="text-lg font-semibold">Stavke</h2>
                    <button type="button" id="add-row" class="border px-3 py-1 rounded">+ Dodaj stavku</button>
                </div>

                <div id="rows" class="space-y-3">
                    @php
                        $stavkeOld = old('stavke');
                        $stavke = $stavkeOld ?? $porudzbina->stavkaPorudzbines->map(fn($x) => [
                            'koktel_id' => $x->koktel_id,
                            'kolicina' => $x->kolicina,
                        ])->toArray();
                    @endphp

                    @foreach($stavke as $i => $s)
                        <div class="row border rounded p-3 flex gap-3 items-end">
                            <div class="flex-1">
                                <label class="block text-sm mb-1">Koktel</label>
                                <select name="stavke[{{ $i }}][koktel_id]" class="w-full border rounded px-3 py-2">
                                    @foreach($kokteli as $k)
                                        <option value="{{ $k->id }}" @selected((int)$s['koktel_id'] === (int)$k->id)>
                                            {{ $k->ime ?? $k->naziv }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="w-40">
                                <label class="block text-sm mb-1">Kolicina</label>
                                <input type="number" min="1" name="stavke[{{ $i }}][kolicina]"
                                       class="w-full border rounded px-3 py-2"
                                       value="{{ $s['kolicina'] }}">
                            </div>

                            <button type="button" class="remove border px-3 py-2 rounded">Ukloni</button>
                        </div>
                    @endforeach
                </div>

                @error('stavke') <div class="text-red-600 text-sm">{{ $message }}</div> @enderror
                @error('stavke.*.koktel_id') <div class="text-red-600 text-sm">{{ $message }}</div> @enderror
                @error('stavke.*.kolicina') <div class="text-red-600 text-sm">{{ $message }}</div> @enderror
            </div>

            <div class="flex gap-2">
                <button class="border px-4 py-2 rounded">Sacuvaj</button>
                <a href="{{ route('menadzer.porudzbine.index') }}" class="border px-4 py-2 rounded">Nazad</a>
            </div>
        </form>
    </div>

    <script>
        (function () {
            const rows = document.getElementById('rows');
            const addBtn = document.getElementById('add-row');

            function wireRemove(btn){
                btn.addEventListener('click', () => {
                    btn.closest('.row')?.remove();
                    reindex();
                });
            }

            function reindex(){
                const all = rows.querySelectorAll('.row');
                all.forEach((row, idx) => {
                    row.querySelectorAll('select,input').forEach(el => {
                        el.name = el.name.replace(/stavke\[\d+\]/, `stavke[${idx}]`);
                    });
                });
            }

            rows.querySelectorAll('.remove').forEach(wireRemove);

            addBtn.addEventListener('click', () => {
                const idx = rows.querySelectorAll('.row').length;
                const html = `
                    <div class="row border rounded p-3 flex gap-3 items-end">
                        <div class="flex-1">
                            <label class="block text-sm mb-1">Koktel</label>
                            <select name="stavke[${idx}][koktel_id]" class="w-full border rounded px-3 py-2">
                                @foreach($kokteli as $k)
                                    <option value="{{ $k->id }}">{{ $k->ime ?? $k->naziv }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="w-40">
                            <label class="block text-sm mb-1">Kolicina</label>
                            <input type="number" min="1" name="stavke[${idx}][kolicina]" class="w-full border rounded px-3 py-2" value="1">
                        </div>
                        <button type="button" class="remove border px-3 py-2 rounded">Ukloni</button>
                    </div>
                `;
                rows.insertAdjacentHTML('beforeend', html);
                wireRemove(rows.querySelectorAll('.remove')[rows.querySelectorAll('.remove').length - 1]);
            });
        })();
    </script>
</x-app-layout>
