@extends('home')

@section('content')
<div class="container mt-4">
    <h2>Ikasleen zerrenda</h2>

    <form method="GET" action="{{ route('students.index') }}" class="mb-3">
        <div class="input-group">
            <input type="number" name="adinMax" class="form-control" placeholder="Adin minimoa" value="{{ request('adinMax') }}">
            <button class="btn btn-primary">Filtratu</button>
        </div>
    </form>

    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Izena</th>
                <th>Adina</th>
                <th>Ikusi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($ikasleak as $ikasle)
            <tr>
                <td>{{ $ikasle['id'] }}</td>
                <td>{{ $ikasle['izena'] }}</td>
                <td>{{ $ikasle['adina'] }}</td>
                <td>
                    <a href="{{ route('students.show', $ikasle['id']) }}" class="btn btn-sm btn-info">
                        Ikusi
                    </a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
