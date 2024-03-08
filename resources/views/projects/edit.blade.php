@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Modifica Progetto</h1>
        <form action="{{ route('projects.update', $project->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="title">Titolo</label>
                <input type="text" class="form-control" id="title" name="title"
                    value="{{ old('title', $project->title) }}" required>
            </div>

            <div class="form-group">
                <label for="description">Descrizione</label>
                <textarea class="form-control" id="description" name="description" required>{{ old('description', $project->description) }}</textarea>
            </div>

            <div class="form-group">
                <label for="type_id">Tipo</label>
                <select class="form-control" id="type_id" name="type_id">
                    @foreach ($types as $type)
                        <option value="{{ $type->id }}" {{ $project->type_id == $type->id ? 'selected' : '' }}>
                            {{ $type->name }}</option>
                    @endforeach
                </select>
            </div>

            @foreach ($technologies as $technology)
                <label>
                    <input type="checkbox" name="technologies[]" value="{{ $technology->id }}"
                        {{ in_array($technology->id, $project->technologies->pluck('id')->toArray()) ? 'checked' : '' }}>
                    {{ $technology->name }}
                </label>
            @endforeach

            <button type="submit">Aggiorna</button>
        </form>
        <form method="POST" action="{{ route('projects.destroy', $project) }}">
            @csrf
            @method('DELETE')
            <button type="submit">Cancella Progetto</button>
        </form>
    </div>
@endsection
