<x-app-layout>
 <div class="max-w-6xl mx-auto p-6 space-y-6">
      <div class="mb-4">
          <a href="{{ route('menadzer.dashboard') }}"
            class="inline-block border px-4 py-2 rounded">
              ← Nazad na dashboard
          </a>
      </div>

    <h1 class="font-bold text-2xl">Kokteli</h1>
    <div class="mb-4">
      <a href="{{ route('koktels.create') }}"
        class="inline-block border px-4 py-2 rounded hover:bg-gray-50">
        + Dodaj koktel
      </a>
    </div>

    <ul class="space-y-6">
      @foreach($kokteli as $k)
        <li class="flex items-center justify-between border rounded p-3">
          <div>
            <div class="font-semibold">{{ $k->naziv }}</div>
            <div class="text-sm text-gray-600">cena: {{ number_format($k->cena, 2) }}</div>
          </div>

          <div class="flex items-center gap-2">
            <a
              href="{{ route('koktels.edit', $k) }}"
              class="border px-3 py-1 rounded hover:bg-gray-50"
            >
              Izmeni
            </a>

            <form method="POST" action="{{ route('koktels.destroy', $k) }}"
                  onsubmit="return confirm('Da li si siguran da želiš da obrišeš ovaj koktel?');">
              @csrf
              @method('DELETE')
              <button type="submit" class="border px-3 py-1 rounded hover:bg-red-50">
                Obrisi
              </button>
            </form>
          </div>
        </li>
      @endforeach
    </ul>

  </div>
</x-app-layout>

