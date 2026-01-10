<x-app-layout>
  <div class="max-w-6xl mx-auto p-6 space-y-6">
    <div class="flex items-center justify-between">
      <h1 class="text-3xl font-bold">Presek smene - {{ now()->format('d.m.Y') }}</h1>
      <a href="{{ route('menadzer.dashboard') }}" class="border px-4 py-2 rounded">← Nazad na dashboard</a>
    </div>

    <div class="border rounded p-4 text-lg">
      Ukupno: <span class="font-bold">{{ number_format($ukupno, 2) }}</span>
    </div>

    @forelse($porudzbine as $p)
      @php
        $total = $p->stavkaPorudzbines->sum(fn($s) => ($s->kolicina ?? 0) * ($s->koktel->cena ?? 0));
      @endphp

      <div class="border rounded p-4">
        <div class="flex justify-between">
          <div><b>#{{ $p->id }}</b> | Sto: {{ $p->broj_stola }}</div>
          <div>{{ optional($p->isporuceno_at)->format('H:i') }}</div>
        </div>

        <div class="mt-2 text-sm text-gray-700">
          <b>Stavke:</b>
          <ul class="list-disc ml-6">
            @foreach($p->stavkaPorudzbines as $s)
              <li>{{ $s->koktel->naziv ?? 'Nepoznat koktel' }} × {{ $s->kolicina }}</li>
            @endforeach
          </ul>
        </div>

        <div class="mt-2">
          Ukupno porudzbina: <b>{{ number_format($total, 2) }}</b>
        </div>
      </div>
    @empty
      <p>Nema isporučenih porudzbina za danas</p>
    @endforelse
  </div>
</x-app-layout>
