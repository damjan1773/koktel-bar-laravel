<h1>Korisnici</h1>

<ul>
  @foreach($korisniks as $k)
    <li>{{ $k->ime }} {{ $k->prezime }} | uloga: {{ $k->uloga }}</li>
  @endforeach
</ul>
