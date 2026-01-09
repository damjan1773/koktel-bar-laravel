<x-app-layout>
<h1>Porudzbine</h1>

<a class="underline" href="{{ route('konobar.porudzbine.create') }}">Nova porudzbina</a>

<ul>
  @foreach($porudzbinas as $p)
    <li>#{{ $p->id }} | sto: {{ $p->broj_stola }} | status: {{ $p->status }}</li>
  @endforeach
</ul>
</x-app-layout>

