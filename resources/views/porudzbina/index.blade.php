<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Porudzbine (Konobar)
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8 space-y-8">

            
            <div class="bg-white p-6 shadow-sm sm:rounded-lg">
                <h3 class="text-lg font-bold mb-4">Porudzbine u pripremi</h3>

                @forelse($uPripremi as $p)
                    <div class="border rounded p-4 mb-3">
                        <div>#{{ $p->id }} | Sto: {{ $p->broj_stola }} | Status: {{ $p->status }}</div>

                        <div class="mt-2 text-sm text-gray-700">
                            <b>Stavke:</b>
                            <ul class="list-disc ml-6">
                                @foreach($p->stavkaPorudzbines as $stavka)
                                    <li>{{ $stavka->koktel->naziv ?? 'Nepoznat koktel' }} × {{ $stavka->kolicina }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                @empty
                    <div class="text-gray-500">Nema porudzbina u pripremi</div>
                @endforelse
            </div>
            
            <div class="bg-white p-6 shadow-sm sm:rounded-lg">
                <h3 class="text-lg font-bold mb-4">Spremne porudzbine</h3>

                @forelse($spremne as $p)
              <div class="border rounded p-4 mb-3 flex justify-between items-start gap-4">
                <div>
                  <div>#{{ $p->id }} | Sto: {{ $p->broj_stola }} | Status: {{ $p->status }}</div>

                  <div class="mt-2 text-sm text-gray-700">
                    <b>Stavke:</b>
                    <ul class="list-disc ml-6">
                      @foreach($p->stavkaPorudzbines as $stavka)
                        <li>{{ $stavka->koktel->naziv ?? 'Nepoznat koktel' }} × {{ $stavka->kolicina }}</li>
                      @endforeach
                    </ul>
                  </div>
                </div>

                <form method="POST" action="{{ route('konobar.porudzbine.isporuceno', $p) }}">
                  @csrf
                  <button class="border px-4 py-2 rounded hover:bg-gray-50">
                    Isporuceno
                  </button>
                </form>
              </div>
            @empty
              <div class="text-gray-500">Nema spremnih porudzbina</div>
            @endforelse
            </div>

        </div>
    </div>
</x-app-layout>


