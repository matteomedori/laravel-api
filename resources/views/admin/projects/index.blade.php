@extends('layouts.admin')

@section('content')
    <h2 class="my-3">Lista dei progetti</h2>
    <a href="{{ route('admin.projects.create') }}" class="btn btn-primary btn-sm">Aggiungi un nuovo progetto</a>

    {{-- show toast if exist a message --}}
    @if (session('messages'))
        <div class="toast show position-fixed bottom-0 end-0 p-1 align-items-center text-bg-success border-0" role="alert"
            aria-live="assertive" aria-atomic="true">
            <div class="d-flex">
                <div class="toast-body">
                    {{ session('messages') }}
                </div>
                <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"
                    aria-label="Close"></button>
            </div>
        </div>
    @endif
    {{-- /show toast if exist a message --}}

    {{-- table to show projects --}}
    <table class="table table-striped mt-2">
        <thead>
            <tr>
                <th scope="col">Titolo</th>
                <th scope="col">Descrizione</th>
                <th scope="col">Linguaggi</th>
                <th scope="col">Frameworks</th>
                <th scope="col">Tipologia</th>
                <th scope="col"></th>
                <th scope="col"></th>
                <th scope="col"></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($projects as $project)
                <tr>
                    <td>{{ $project->title }}</td>
                    <td>{{ $project->description }}</td>
                    <td>{{ $project->languages }}</td>
                    <td>{{ $project->frameworks }}</td>
                    <td>{{ $project->type?->name }}</td>
                    <td><a href="{{ route('admin.projects.edit', $project) }}" class="btn btn-primary btn-sm">modifica</a>
                    </td>
                    <td><a href="{{ route('admin.projects.show', $project) }}" class="btn btn-secondary btn-sm">mostra</a>
                    </td>
                    <td>
                        <form action="{{ route('admin.projects.destroy', $project) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <input type="button" value="cancella" class="btn btn-danger btn-sm" data-bs-toggle="modal"
                                data-bs-target="#modal{{ $loop->iteration }}">
                            <!-- Modal -->
                            <div class="modal fade" id="modal{{ $loop->iteration }}" tabindex="-1"
                                aria-labelledby="modalLabel{{ $loop->iteration }}" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="modalLabel{{ $loop->iteration }}">Sei sicuro
                                                di voler cancellare
                                                il progetto '{{ $project->title }}'?</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-bs-dismiss="modal">No</button>
                                            <input type="submit" value="Si" class="btn btn-primary">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    {{-- /table to show projects --}}
@endsection
