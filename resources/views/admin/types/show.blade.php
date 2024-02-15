@extends('layouts.admin')

@section('content')
    <h2 class="my-3">{{ $type->name }}</h2>
    <p>Slug: {{ $type->slug }}</p>
    <div>Progetti di questo tipo:
        <ul>
            @foreach ($type->projects as $project)
                <li>{{ $project->title }}</li>
            @endforeach
        </ul>
    </div>
    <a href="{{ route('admin.types.index') }}" class="btn btn-info text-light">Torna alla lista delle tipologie</a>
@endsection
