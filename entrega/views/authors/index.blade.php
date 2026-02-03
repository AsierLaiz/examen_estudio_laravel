@extends('layouts.app')

@section('title', 'Egileen Zerrenda')

@section('content')
<table>
    <tr>
        <th>Izena</th>
        <th>Abizenak</th>
        <th>Ekintza</th>
    </tr>
    @foreach($authors as $author)
    <tr>
        <td>{{ $author->izena }}</td>
        <td>{{ $author->abizenak }}</td>
        <td><a href="{{ route('authors.show', $author) }}">Ikusi</a></td>
    </tr>
    @endforeach
</table>
@endsection
