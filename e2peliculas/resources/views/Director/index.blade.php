@extends('layouts.app')

@section('title', 'Egileen Zerrenda')

@section('content')
<table>
    <tr>
        <th>Izena</th>
        <th>Herrialdea</th>
        <th>Ekintza</th>
    </tr>
    @foreach($directors as $director)
    <tr>
        <td>{{ $director->nombre }}</td>
        <td>{{ $director->pais }}</td>
        <td><a href="{{ route('director.show', $director) }}">Ikusi</a></td>
    </tr>
    @endforeach
</table>
@endsection
