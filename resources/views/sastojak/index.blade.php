<h1>Sastojci</h1>

<ul>
  @foreach($sastojci as $s)
    <li>{{ $s->ime }}</li>
  @endforeach
</ul>

