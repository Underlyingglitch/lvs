<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\SchoolYear;
use Illuminate\Http\Request;

class ProjectsController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
    }

    public function index()
    {
        $this->authorize('viewAny', Project::class);

        $projects = Project::all()->where([
            ['school_year_id', '=', SchoolYear::current()->id]
        ]);

        return view('projects.index', [
            'projects' => $projects
        ]);
    }

    public function own()
    {
        $this->authorize('viewOwn', Project::class);

        $project = auth()->user()->project;

        if ($project == null) {
            return $this->create();
        }

        return $this->show($project);
    }

    public function create()
    {
        $this->authorize('create', Project::class);

        return view('projects.setup');
    }

    public function store(Request $request)
    {
        $this->authorize('create', Project::class);

        $project = new Project();

        $project->title = $request->title;
        $project->description = $request->description;
        $project->user_id = auth()->user()->id;
        $project->school_year_id = SchoolYear::current()->id;

        $project->save();

        return redirect()->route('projects.own');
    }

    public function show(Project $project)
    {
        $this->authorize('view', $project);
        
        return view('projects.show', [
            'project' => $project
        ]);
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }
}
