<x-app-layout> 
    <div class="max-w-6xl mx-auto p-6 space-y-6">

        <div class="flex items-center justify-between">
            <h1 class="text-2xl font-bold">Sastojci</h1>

            <a href="{{ route('menadzer.dashboard') }}"
               class="border px-4 py-2 rounded">
                ← Nazad na dashboard
            </a>
        </div>

        @forelse($sastojci as $s)
            <div class="border rounded p-4 flex items-center justify-between">
                <div>
                    <b>#{{ $s->id }}</b> —
                    {{ $s->naziv ?? $s->ime ?? 'Sastojak' }}
                    <div class="text-sm text-gray-600 mt-1">
                        Stanje: <b>{{ $s->kolicina }}</b> {{ $s->jedinica }}
                    </div>
                </div>

                <div class="flex items-center gap-2">
                    <input
                        type="number"
                        name="delta_ui"
                        value="1"
                        min="1"
                        step="1"
                        class="w-24 border rounded px-2 py-1 text-sm"
                        oninput="
                            this.closest('.flex').querySelectorAll('input[name=delta]').forEach(i => i.value = this.value);
                        "
                    >
                    
                    <form method="POST" action="{{ route('sastojaks.minus', $s) }}">
                        @csrf
                        @method('PATCH')
                        <input type="hidden" name="delta" value="1">
                        <button type="submit" class="border px-3 py-1 rounded">-</button>
                    </form>

                    
                    <form method="POST" action="{{ route('sastojaks.plus', $s) }}">
                        @csrf
                        @method('PATCH')
                        <input type="hidden" name="delta" value="1">
                        <button type="submit" class="border px-3 py-1 rounded">+</button>
                    </form>

                </div>
            </div>
        @empty
            <p>Nema sastojaka</p>
        @endforelse

    </div>
</x-app-layout>


