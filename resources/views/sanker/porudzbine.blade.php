<x-app-layout>
    <div class="max-w-4xl mx-auto p-6">
        <h1 class="text-2xl font-bold mb-4">Porudzbine za pripremu</h1>

        @forelse($porudzbine as $p)
            <div class="border p-4 rounded mb-3">
                <div class="flex justify-between items-center">
                    <div>
                        <b>#{{ $p->id }}</b> | Sto: {{ $p->broj_stola }} | Status: {{ $p->status }}
                    </div>

                    <form method="POST" action="{{ route('sanker.porudzbine.spremno', $p) }}">
                        @csrf
                        <button class="border px-4 py-2">Oznaci kao spremno</button>
                    </form>
                </div>

                <div class="mt-3">
                    <b>Stavke:</b>
                    <ul class="list-disc ml-6">
                        @foreach($p->stavkaPorudzbines as $st)
                            <li>{{ $st->koktel->naziv }} × {{ $st->kolicina }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        @empty
            <p>Nema porudzbina u pripremi</p>
        @endforelse
    </div>
</x-app-layout>
