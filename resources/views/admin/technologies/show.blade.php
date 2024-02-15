@extends('layouts.admin')

@section('content')
    <h2 class="my-3">{{ $technology->name }}</h2>
    <p>Slug: {{ $technology->slug }}</p>
    <div>Progetti che la utilizzano:
        <ul>
            @foreach ($technology->projects as $project)
                <li>{{ $project->title }}</li>
            @endforeach
        </ul>
    </div>
    <a href="{{ route('admin.technologies.index') }}" class="btn btn-info text-light">Torna alla lista delle tecnologie</a>
@endsection
