@extends('home')

@section('content')
<div class="container mt-4">
    <h2>Ikaslearen datuak</h2>

    <table class="table table-bordered w-50">
        <tr>
            <th>ID</th>
            <td>{{ $ikaslea['id'] }}</td>
        </tr>
        <tr>
            <th>Izena</th>
            <td>{{ $ikaslea['izena'] }}</td>
        </tr>
        <tr>
            <th>Adina</th>
            <td>{{ $ikaslea['adina'] }}</td>
        </tr>
    </table>

    <a href="{{ route('students.index') }}" class="btn btn-secondary">← Itzuli</a>
</div>
@endsection
