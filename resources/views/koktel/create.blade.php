<x-app-layout>
    <div class="max-w-3xl mx-auto p-6 space-y-6">

        <div class="flex items-center justify-between">
            <h1 class="text-2xl font-bold">Dodaj koktel</h1>

            <a href="{{ route('koktels.index') }}" class="border px-4 py-2 rounded hover:bg-gray-50">
                ← Nazad
            </a>
        </div>

        @if ($errors->any())
            <div class="border border-red-300 bg-red-50 p-4 rounded">
                <ul class="list-disc ml-5 text-sm">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('koktels.store') }}" class="space-y-4">
            @csrf

            <div>
                <label class="block text-sm font-medium mb-1">Naziv</label>
                <input
                    type="text"
                    name="naziv"
                    value="{{ old('naziv') }}"
                    class="w-full border rounded px-3 py-2"
                    required
                >
            </div>

            <div>
                <label class="block text-sm font-medium mb-1">Cena (RSD)</label>
                <input
                    type="number"
                    name="cena"
                    value="{{ old('cena') }}"
                    class="w-full border rounded px-3 py-2"
                    step="0.01"
                    min="0"
                    required
                >
            </div>

            <div class="flex gap-2">
                <button type="submit" class="border px-4 py-2 rounded hover:bg-gray-50">
                    Sacuvaj
                </button>
                <a href="{{ route('koktels.index') }}" class="border px-4 py-2 rounded hover:bg-gray-50">
                    Otkazi
                </a>
            </div>
        </form>
    </div>
</x-app-layout>

