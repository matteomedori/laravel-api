@extends('layouts.admin')

@section('content')
    <h2 class="my-3">Modifica progetto</h2>
    <form action="{{ route('admin.projects.update', $project) }}" method="POST" class="mt-3">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="title" class="form-label">Titolo</label>
            <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title"
                value="{{ old('title', $project->title) }}">
        </div>
        @error('title')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
        <div class="mb-3">
            <label for="description" class="form-label">Descrizione</label>
            <textarea class="form-control @error('description') is-invalid @enderror" id="description" rows="3"
                name="description">{{ old('description', $project->description) }}</textarea>
        </div>
        @error('description')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
        <div class="mb-3">
            <label for="languages" class="form-label">Linguaggi</label>
            <input type="text" class="form-control @error('languages') is-invalid @enderror" id="languages"
                name="languages" value="{{ old('languages', $project->languages) }}">
        </div>
        @error('languages')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
        <div class="mb-3">
            <label for="frameworks" class="form-label">Frameworks</label>
            <input type="text" class="form-control @error('frameworks') is-invalid @enderror" id="frameworks"
                name="frameworks" value="{{ old('frameworks', $project->frameworks) }}">
        </div>
        @error('frameworks')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
        <div class="mb-3">
            <div>
                <label for="technologies" class="form-label">Tecnologie:</label>
            </div>
            @foreach ($technologies as $technology)
                <div class="form-check form-check-inline">
                    @if ($errors->any())
                        <input class="form-check-input" type="checkbox" id="tech-{{ $technology->id }}"
                            name="technologies[]" value="{{ $technology->id }}"
                            {{ in_array($technology->id, old('technologies', [])) ? 'checked' : '' }}>
                        <label class="form-check-label" for="tech-{{ $technology->id }}">{{ $technology->name }}</label>
                    @else
                        <input class="form-check-input" type="checkbox" id="tech-{{ $technology->id }}"
                            name="technologies[]" value="{{ $technology->id }}"
                            {{ $project->technologies->contains($technology->id) ? 'checked' : '' }}>
                        <label class="form-check-label" for="tech-{{ $technology->id }}">{{ $technology->name }}</label>
                    @endif
                </div>
            @endforeach
        </div>
        @error('technologies')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
        <div class="mb-3">
            <label for="type_id" class="form-label">Tipo</label>
            <select class="form-select @error('type_id') is-invalid @enderror" aria-label="Default select example"
                name="type_id">
                <option selected>Seleziona tipo progetto</option>
                @foreach ($types as $type)
                    <option value="{{ $type->id }}" @if (old('type_id', $project->type_id) == $type->id) selected @endif>
                        {{ $type->name }}</option>
                @endforeach
            </select>
        </div>
        @error('type_id')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
        <input type="submit" value="Modifica" class="btn btn-primary">
        <a href="{{ route('admin.projects.index') }}" class="btn btn-info text-light">Torna alla lista progetti</a>
    </form>
@endsection
