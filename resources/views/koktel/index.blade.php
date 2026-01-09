<x-app-layout>
<h1>Kokteli</h1>

<ul>
  @foreach($kokteli as $k)
    <li>{{ $k->ime }} | cena: {{ $k->cena }}</li>
  @endforeach
</ul>
</x-app-layout>

