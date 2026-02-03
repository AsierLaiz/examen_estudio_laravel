@extends('layouts.app')

@section('title', $author->izena . ' ' . $author->abizenak)

@section('content')
<h2>{{ $author->izena }} {{ $author->abizenak }}</h2>
<h3>Liburuak:</h3>
<ul>
    @foreach($author->books as $book)
        <li>{{ $book->izenburua }} ({{ $book->argitalpen_urtea }})</li>
    @endforeach
</ul>
<a href="{{ route('authors.index') }}">Itzuli zerrendara</a>
@endsection
