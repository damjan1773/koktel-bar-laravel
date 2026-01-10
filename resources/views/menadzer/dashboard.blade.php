<x-app-layout>
    <div class="max-w-5xl mx-auto p-6 space-y-6">
        <h1 class="text-2xl font-bold">Menadzer Dashboard</h1>
        <div class="flex gap-3">

            <a href="{{ route('koktels.index') }}" class="border px-4 py-2 rounded">Kokteli</a>

            <a href="{{ route('sastojaks.index') }}" class="border px-4 py-2 rounded">Sastojci</a>

            <a href="{{ route('menadzer.porudzbine.index') }}" class="border px-4 py-2 rounded">Porudzbine</a>

        </div>
    </div>
</x-app-layout>

