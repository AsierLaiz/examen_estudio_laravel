@extends('home')

@section('content')
<div class="container mt-4">
    <h2>{{ $group->name }}</h2>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Izena</th>
                <th>Abizenak</th>
                <th>Adina</th>
            </tr>
        </thead>
        <tbody>
            @foreach($group->students as $student)
            <tr>
                <td>{{ $student->name }}</td>
                <td>{{ $student->surnames }}</td>
                <td>{{ $student->age }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <a href="{{ route('groups.index') }}" class="btn btn-secondary">← Itzuli</a>
</div>
@endsection