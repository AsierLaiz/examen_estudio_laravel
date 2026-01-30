@extends('home')

@section('content')
<div class="container mt-4">
    <h2>Taldeak</h2>
    <ul class="list-group">
        @foreach($groups as $group)
        <li class="list-group-item d-flex justify-content-between align-items-center">
            <a href="{{ route('groups.show', $group->id) }}">{{ $group->name }}</a>
            <span class="badge bg-primary rounded-pill">{{ $group->students_count }}</span>
        </li>
        @endforeach
    </ul>
</div>
@endsection