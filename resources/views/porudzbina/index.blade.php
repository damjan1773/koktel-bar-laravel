<h1>Porudzbine</h1>

<ul>
  @foreach($porudzbinas as $p)
    <li>#{{ $p->id }} | sto: {{ $p->broj_stola }} | status: {{ $p->status }}</li>
  @endforeach
</ul>

