<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProjectRequest;
use App\Http\Requests\UpdateProjectRequest;
use App\Models\Project;
use App\Models\Technology;
use App\Models\Type;
use Illuminate\Http\Request;
use Illuminate\Support\Str;


class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $projects = Project::all();
        return view('admin.projects.index', compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $types = Type::all();

        $technologies = Technology::all();

        return view('admin.projects.create', compact('types', 'technologies'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProjectRequest $request)
    {
        $data = $request->validated();

        $newproject = new Project();
        $newproject->fill($data);
        $newproject->slug = Str::of($newproject->title)->slug('-');
        $newproject->save();

        if (isset($data['technologies'])) {
            $newproject->technologies()->sync($data['technologies']);
        }

        return redirect()->route('admin.projects.index')->with('messages', "Progetto '$newproject->title' aggiunto correttamente");
    }

    /**
     * Display the specified resource.
     */
    public function show(Project $project)
    {
        return view('admin.projects.show', compact('project'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Project $project)
    {
        $types = Type::all();

        $technologies = Technology::all();

        return view('admin.projects.edit', compact('project', 'types', 'technologies'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProjectRequest $request, Project $project)
    {
        $data = $request->validated();

        $project->slug = Str::of($project->title)->slug('-');
        $project->update($data);

        if ($request->has('technologies')) {
            $project->technologies()->sync($data['technologies']);
        } else {
            $project->technologies()->sync([]);
        }

        return redirect()->route('admin.projects.index')->with('messages', "Progetto '$project->title' modificato correttamente");;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project $project)
    {
        $project->technologies()->sync([]);
        $title = $project->title;
        $project->delete();
        return redirect()->route('admin.projects.index')->with('messages', "Progetto '$title' cancellato correttamente");
    }
}
