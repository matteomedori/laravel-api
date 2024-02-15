@extends('layouts.admin')

@section('content')
    <h2 class="my-3">{{ $project->title }}</h2>
    <p>{{ $project->description }}</p>
    <p>Linguaggi utilizzati: {{ $project->languages }}</p>
    <p>Framework utilizzati: {{ $project->frameworks }}</p>
    <p>Tipo: {{ $project->type?->name ?: 'nessun tipo' }}</p>
    <div>Tecnologie:
        <ul>
            @foreach ($project->technologies as $technology)
                <li>{{ $technology->name }}</li>
            @endforeach
        </ul>
    </div>
    <a href="{{ route('admin.projects.index') }}" class="btn btn-info text-light">Torna alla lista progetti</a>
@endsection
