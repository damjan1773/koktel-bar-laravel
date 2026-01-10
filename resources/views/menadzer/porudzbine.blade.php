<x-app-layout>
    <div class="max-w-6xl mx-auto p-6 space-y-6">
        <h1 class="text-2xl font-bold">Porudzbine (Menadzer)</h1>
        <div class="mb-4">
            <a href="{{ route('menadzer.dashboard') }}"
            class="inline-block border px-4 py-2 rounded">
                ← Nazad na dashboard
            </a>
        </div>

        @forelse($porudzbine as $p)
            <div class="border rounded p-4 flex justify-between items-start">
                <div>
                    <b>#{{ $p->id }}</b> |
                    Sto: {{ $p->broj_stola }} |
                    Status: {{ $p->status }}

                    <ul class="ml-4 list-disc text-sm mt-2">
                        @foreach($p->stavkaPorudzbines as $stavka)
                            <li>
                                {{ $stavka->koktel->naziv ?? $stavka->koktel->ime ?? 'N/A' }}
                            </li>
                        @endforeach
                    </ul>
                </div>
                
                <div class="flex gap-2">
                    
                    <a href="{{ route('menadzer.porudzbine.edit', $p) }}" class="border px-3 py-1 rounded">Izmeni</a>

                    
                    <form method="POST"
                          action="{{ route('menadzer.porudzbine.destroy', $p) }}"
                          onsubmit="return confirm('Obrisati porudzbinu?')">
                        @csrf
                        @method('DELETE')

                        <button class="border px-3 py-1 rounded">
                            Obrisi
                        </button>
                    </form>
                </div>
            </div>
        @empty
            <p>Nema porudzbina</p>
        @endforelse
    </div>
</x-app-layout>

