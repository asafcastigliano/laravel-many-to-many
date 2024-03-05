@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Projects Dashboard</h1>

        <form action="{{ route('projects.store') }}" method="POST">
            @csrf
            <input type="text" name="title" placeholder="Project Title" required>
            <textarea name="description" placeholder="Project Description" required></textarea>

            <select name="type_id" required>
                <option value="">Select Type</option>
                @foreach ($types as $type)
                    <option value="{{ $type->id }}">{{ $type->name }}</option>
                @endforeach
            </select>

            <button type="submit">Add Project</button>
        </form>

        <h2>Existing Projects</h2>
        @foreach ($projects as $project)
            <div class="project">
                <h3>{{ $project->title }}</h3>
                <p>{{ $project->description }}</p>

                <form action="{{ route('projects.update', $project->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <input type="text" name="title" value="{{ $project->title }}" required>
                    <textarea name="description" required>{{ $project->description }}</textarea>

                    <select name="type_id" required>
                        <option value="">Select Type</option>
                        @foreach ($types as $type)
                            <option value="{{ $type->id }}" {{ $project->type_id == $type->id ? 'selected' : '' }}>
                                {{ $type->name }}</option>
                        @endforeach
                    </select>

                    <button type="submit">Update</button>
                </form>

                <form action="{{ route('projects.destroy', $project->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit">Delete</button>
                </form>
            </div>
        @endforeach
    </div>
@endsection
