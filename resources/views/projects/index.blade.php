@extends('layouts.app')

@section('content')
    <h2>Existing Projects</h2>
    <a href="{{ route('projects.create') }}">Nuovo Progetto</a>

    @foreach ($projects as $project)
        <div class="project">
            <h3>{{ $project->title }}</h3>
            <p>{{ $project->description }}</p>
            <p>{{ $project->type->name ?? 'None' }}</p>
            @if ($project->technologies->count() > 0)
                <h4>Tecnologie Utilizzate:</h4>
                <ul>
                    @foreach ($project->technologies as $technology)
                        <li>{{ $technology->name }}</li>
                    @endforeach
                </ul>
            @endif
            <a href="{{ route('projects.edit', $project->id) }}">Modifica</a>
        </div>
    @endforeach
@endsection
