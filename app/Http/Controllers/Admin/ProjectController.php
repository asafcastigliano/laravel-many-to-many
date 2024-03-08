<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\Type;
use App\Models\Technology;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $projects = Project::all();
        $types = Type::all();
        $technologies = Technology::all();
        return view('projects.index', compact('projects', 'types', 'technologies'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Project $project)
    {
        $types = Type::all();
        $technologies = Technology::all();
        return view('projects.create', compact('project', 'types', 'technologies'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'type_id' => 'required|exists:types,id',
            'technology_id.*' => 'exists:technologies,id',
        ]);
    
        $project = Project::create($request->except('technologies'));
    
        $project->technologies()->sync($request->technologies);
    
        return redirect()->route('projects.index')->with('success', 'Project created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $project = Project::with(['type', 'technologies'])->findOrFail($id);
        return view('projects.show', compact('project'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Project $project)
    {
        $types = Type::all();
        $technologies = Technology::all();
        return view('projects.edit', compact('project', 'types', 'technologies'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Project $project)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'type_id' => 'required|exists:types,id',
            'technologies' => 'array',
            'technologies.*' => 'exists:technologies,id',
        ]);
    
        $project->update($request->except('technologies'));
    
        $project->technologies()->sync($request->technologies);
    
        return redirect()->route('projects.index')->with('success', 'Project updated successfully');
    }

    /**
    * Remove the specified resource from storage.
    */
    public function destroy($id)
    {
        $project = Project::findOrFail($id);
        $project->delete();

        return redirect()->route('projects.index')->with('success', 'Project deleted successfully');
    }
}