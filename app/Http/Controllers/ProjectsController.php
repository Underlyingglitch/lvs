<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\SchoolYear;
use Illuminate\Http\Request;

class ProjectsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // TODO: Implement authentication
        // TODO: Project overview
    }

    public function own()
    {
        $this->authorize('projects.owns');

        $project = auth()->user()->project;

        if ($project == null) {
            // TODO: redirect to setup screen
            return $this->create();
        }

        abort_unless(($project->user_id == auth()->user()->id), 403);

        return $this->show($project->id);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // TODO: Implement authentication
        return view('projects.setup');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // TODO: Implement authentication
        $project = new Project();

        $project->title = $request->title;
        $project->description = $request->description;
        $project->user_id = auth()->user()->id;
        $project->school_year_id = SchoolYear::current();

        $project->save();

        return redirect()->route('projects.own');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // TODO: Implement authentication
        $project = Project::find($id);
        return view('projects.show', [
            'project' => $project
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
