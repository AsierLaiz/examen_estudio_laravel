@extends('layouts.app')

@section('title', $director->nombre)

@section('content')
<h2>{{ $director->nombre }} - {{ $director->pais }}</h2>
<h3>Pelikulak:</h3>
<ul>
    @foreach($director->peliculas as $movie)
        <li>{{ $movie->titulo }} ({{ $movie->ano_estreno }})</li>
    @endforeach
</ul>
<a href="{{ route('director.index') }}">Itzuli zerrendara</a>
@endsection
