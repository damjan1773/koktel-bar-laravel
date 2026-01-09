<x-app-layout>
    <div class="max-w-5xl mx-auto p-6 space-y-10">

        
        <div>
            <h1 class="text-2xl font-bold mb-4">Porudzbine u pripremi</h1>

            @if($uPripremi->isEmpty())
                <p>Nema porudzbina u pripremi</p>
            @else
                <div class="space-y-3">
                    @foreach($uPripremi as $p)
                        <div class="border p-4 rounded">
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
                                @if(!empty($p->napomena))
                                    <div class="mt-2 text-sm text-gray-700">
                                        <b>Napomena:</b> {{ $p->napomena }}
                                    </div>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>

        <div>
            <h2 class="text-2xl font-bold mb-4">Spremne porudzbine</h2>

            @if($spremne->isEmpty())
                <p>Nema spremnih porudzbina</p>
            @else
                <div class="space-y-3">
                    @foreach($spremne as $p)
                        <div class="border p-4 rounded">
                            <div>
                                <b>#{{ $p->id }}</b> | Sto: {{ $p->broj_stola }} | Status: {{ $p->status }}
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
                    @endforeach
                </div>
            @endif
        </div>

    </div>
</x-app-layout>

