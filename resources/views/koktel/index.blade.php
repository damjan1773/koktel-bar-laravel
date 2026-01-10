<x-app-layout>
 <div class="max-w-6xl mx-auto p-6 space-y-6">
      <div class="mb-4">
          <a href="{{ route('menadzer.dashboard') }}"
            class="inline-block border px-4 py-2 rounded">
              ← Nazad na dashboard
          </a>
      </div>

    <h1 class="font-bold text-2xl">Kokteli</h1>

    <ul class="space-y-6">
      @foreach($kokteli as $k)
        <li>{{ $k->naziv }} | cena: {{ $k->cena }}</li>
      @endforeach
    </ul>
  </div>
</x-app-layout>

