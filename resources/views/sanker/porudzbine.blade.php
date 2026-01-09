<x-app-layout>
    <div class="py-6">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8 space-y-8">

            <h1 class="text-2xl font-bold">Porudzbine (Sanker)</h1>

            <div class="bg-white p-6 shadow-sm sm:rounded-lg">
                <h2 class="text-lg font-bold mb-4">Porudzbine u pripremi</h2>

                @forelse($uPripremi as $p)
                    <div class="border rounded p-4 mb-3 flex justify-between items-start gap-4">
                        <div>
                            <div class="font-semibold">
                                #{{ $p->id }} | Sto: {{ $p->broj_stola }} | Status: {{ $p->status }}
                            </div>

                            <div class="mt-2 text-sm text-gray-700">
                                <b>Stavke:</b>
                                <ul class="list-disc ml-6">
                                    @foreach($p->stavkaPorudzbines as $st)
                                        <li>
                                            {{ $st->koktel->naziv ?? 'Nepoznat koktel' }} × {{ $st->kolicina }}
                                        </li>
                                    @endforeach
                                </ul>
                            </div>

                            @if(!empty($p->napomena))
                                <div class="mt-2 text-sm text-gray-700">
                                    <b>Napomena:</b> {{ $p->napomena }}
                                </div>
                            @endif
                        </div>

                        <form method="POST" action="{{ route('sanker.porudzbine.spremno', $p) }}">
                            @csrf
                            <button class="border px-4 py-2 rounded hover:bg-gray-50">
                                Oznaci kao spremno
                            </button>
                        </form>
                    </div>
                @empty
                    <p class="text-gray-500">Nema porudzbina u pripremi</p>
                @endforelse
            </div>

            <div class="bg-white p-6 shadow-sm sm:rounded-lg">
                <h2 class="text-lg font-bold mb-4">Spremne porudzbine</h2>

                @forelse($spremne as $p)
                    <div class="border rounded p-4 mb-3">
                        <div class="font-semibold">
                            #{{ $p->id }} | Sto: {{ $p->broj_stola }} | Status: {{ $p->status }}
                        </div>

                        <div class="mt-2 text-sm text-gray-700">
                            <b>Stavke:</b>
                            <ul class="list-disc ml-6">
                                @foreach($p->stavkaPorudzbines as $st)
                                    <li>
                                        {{ $st->koktel->naziv ?? 'Nepoznat koktel' }} × {{ $st->kolicina }}
                                    </li>
                                @endforeach
                            </ul>
                        </div>

                        @if(!empty($p->napomena))
                            <div class="mt-2 text-sm text-gray-700">
                                <b>Napomena:</b> {{ $p->napomena }}
                            </div>
                        @endif
                    </div>
                @empty
                    <p class="text-gray-500">Nema spremnih porudzbina</p>
                @endforelse
            </div>

        </div>
    </div>
</x-app-layout>
