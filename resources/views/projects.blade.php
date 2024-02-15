@extends('layouts.app')
@section('content')
    <div class="jumbotron p-5 mb-4 bg-light rounded-3">
        <div class="container py-2">

            <h1 class="display-5 fw-bold">
                Projects
            </h1>

            <table class="table table-striped mt-3 ">
                <thead>
                    <tr class="table-success">
                        <th scope="col">Titolo</th>
                        <th scope="col">Descrizione</th>
                        <th scope="col">Linguaggi</th>
                        <th scope="col">Frameworks</th>
                        <th scope="col">Tipologia</th>
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
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <div class="content">

    </div>
@endsection
