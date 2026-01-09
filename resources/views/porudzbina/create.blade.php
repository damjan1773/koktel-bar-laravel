<x-app-layout>
    <div class="py-6 max-w-xl mx-auto">
        <div class="bg-white p-6 shadow-sm sm:rounded-lg space-y-4">

            <h2 class="text-xl font-bold">Nova porudzbina</h2>

            <form method="POST" action="{{ route('konobar.porudzbine.store') }}" class="space-y-4">
                @csrf

                <div>
                    <label class="block text-sm font-medium">Broj stola</label>
                    <input name="broj_stola" type="number" min="1"
                           class="border p-2 w-full rounded"
                           required value="{{ old('broj_stola') }}">
                    @error('broj_stola') <div class="text-red-600 text-sm">{{ $message }}</div> @enderror
                </div>
                
                <div class="mb-4">
                    <label class="block mb-1">Napomena</label>
                    <textarea name="napomena" rows="3" class="border p-2 w-full">{{ old('napomena') }}</textarea>
                </div>

                <div class="space-y-2">
                    <div class="flex items-center justify-between">
                        <label class="block text-sm font-medium">Stavke (kokteli)</label>
                        <button type="button" id="add-row"
                                class="border px-3 py-1 rounded hover:bg-gray-50">
                            + Dodaj koktel
                        </button>
                    </div>

                    <div id="stavke-wrapper" class="space-y-2">
                        {{-- PRvi red --}}
                        <div class="stavka-row border rounded p-3 flex gap-2 items-end">
                            <div class="flex-1">
                                <label class="block text-sm">Koktel</label>
                                <select name="stavke[0][koktel_id]" class="border p-2 w-full rounded" required>
                                    <option value="">-- izaberi --</option>
                                    @foreach($kokteli as $k)
                                        <option value="{{ $k->id }}">
                                            {{ $k->naziv }} ({{ $k->cena }})
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="w-28">
                                <label class="block text-sm">Kolicina</label>
                                <input name="stavke[0][kolicina]" type="number" min="1"
                                       class="border p-2 w-full rounded" value="1" required>
                            </div>

                            <button type="button"
                                    class="remove-row border px-3 py-2 rounded hover:bg-gray-50"
                                    disabled>
                                Obrisi
                            </button>
                        </div>
                    </div>

                    @error('stavke') <div class="text-red-600 text-sm">{{ $message }}</div> @enderror
                    @error('stavke.*.koktel_id') <div class="text-red-600 text-sm">{{ $message }}</div> @enderror
                    @error('stavke.*.kolicina') <div class="text-red-600 text-sm">{{ $message }}</div> @enderror
                </div>

                <div class="flex gap-2">
                    <button class="border px-4 py-2 rounded hover:bg-gray-50">Sacuvaj</button>
                    <a href="{{ route('konobar.porudzbine.index') }}" class="border px-4 py-2 rounded hover:bg-gray-50">
                        Nazad
                    </a>
                </div>
            </form>
        </div>
    </div>

    <script>
        (function () {
            const wrapper = document.getElementById('stavke-wrapper');
            const addBtn = document.getElementById('add-row');

            function updateRemoveButtons() {
                const rows = wrapper.querySelectorAll('.stavka-row');
                rows.forEach((row, idx) => {
                    const btn = row.querySelector('.remove-row');
                    btn.disabled = (rows.length === 1);
                });
            }

            addBtn.addEventListener('click', () => {
                const rows = wrapper.querySelectorAll('.stavka-row');
                const nextIndex = rows.length;

                const newRow = rows[0].cloneNode(true);

                
                newRow.querySelector('select').name = `stavke[${nextIndex}][koktel_id]`;
                newRow.querySelector('select').value = '';
                newRow.querySelector('input[type="number"]').name = `stavke[${nextIndex}][kolicina]`;
                newRow.querySelector('input[type="number"]').value = 1;

                newRow.querySelector('.remove-row').disabled = false;

                wrapper.appendChild(newRow);
                updateRemoveButtons();
            });

            wrapper.addEventListener('click', (e) => {
                if (!e.target.classList.contains('remove-row')) return;
                const rows = wrapper.querySelectorAll('.stavka-row');
                if (rows.length === 1) return;

                e.target.closest('.stavka-row').remove();

                
                const newRows = wrapper.querySelectorAll('.stavka-row');
                newRows.forEach((row, idx) => {
                    row.querySelector('select').name = `stavke[${idx}][koktel_id]`;
                    row.querySelector('input[type="number"]').name = `stavke[${idx}][kolicina]`;
                });

                updateRemoveButtons();
            });

            updateRemoveButtons();
        })();
    </script>
</x-app-layout>

