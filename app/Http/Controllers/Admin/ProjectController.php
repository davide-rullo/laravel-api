<?php

namespace App\Http\Controllers\Admin;

use App\Models\Project;
use App\Http\Requests\StoreProjectRequest;
use App\Http\Requests\UpdateProjectRequest;
use App\Http\Controllers\Controller;
use App\Models\Technology;
use App\Models\Type;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $projects = Project::orderByDesc('id')->paginate(10);
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
        //dd($request->all());
        $valid_data = $request->validated();
        //dd($valid_data);

        $valid_data['slug'] = Str::slug($request->title, '-');

        if ($request->has('cover_image')) {
            $path = Storage::put('projects_images', $request->cover_image);
            $valid_data['cover_image'] = $path;
        }

        // dd($valid_data);

        $project = Project::create($valid_data);
        $project->technologies()->attach($request->technologies);

        return to_route('admin.projects.index')->with('message', 'New project added');
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

        $valid_data = $request->validated();

        if ($request->has('cover_image')) {
            $path = Storage::put('projects_images', $request->cover_image);
            $valid_data['cover_image'] = $path;
        }

        //soluzione per problema slug
        if (!Str::is($project->getOriginal('title'), $request->title)) {

            $valid_data['slug'] = $project->generateSlug($request->title);
        }

        $project->update($valid_data);

        if ($request->has('technologies')) {
            $project->technologies()->sync($request->technologies);
        }


        return to_route('admin.projects.index')->with('message', 'Project modified successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project $project)
    {
        if ($project->cover_image) {
            Storage::delete($project->cover_image);
        }

        $project->technologies()->detach();

        $project->delete();
        return to_route('admin.projects.index')->with('message', 'Project deleted successfully');
    }
}
