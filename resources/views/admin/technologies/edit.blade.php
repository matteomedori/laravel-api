@extends('layouts.admin')

@section('content')
    <h2 class="my-3">Modifica tecnologia</h2>
    <form action="{{ route('admin.technologies.update', $technology) }}" method="POST" class="mt-3">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="name" class="form-label">Nome</label>
            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name"
                value="{{ old('name', $technology->name) }}">
        </div>
        @error('name')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
        <input type="submit" value="Modifica" class="btn btn-primary">
        <a href="{{ route('admin.technologies.index') }}" class="btn btn-info text-light">Torna alla lista delle
            tecnologie</a>
    </form>
@endsection
