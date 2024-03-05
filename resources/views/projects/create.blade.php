@extends('layouts.app')

@section('content')
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
@endsection
