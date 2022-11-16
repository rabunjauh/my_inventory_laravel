<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index()
	{
		return view('/project/index', [
			"title" => "Project Data",
      "projects" => Project::all()
		]);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create()
	{
		return view('/project/create', [
      "title" => "Add Project"
    ]);
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $request)
	{
		$validatedData = $request->validate([
      'name' => 'required|max:255|unique:projects'
    ]);

    $validatedData['name'] = ucwords($validatedData['name']);

    Project::create($validatedData);
    return redirect('/project')->with('success', 'Project data successfully added');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  \App\Models\Project  $project
	 * @return \Illuminate\Http\Response
	 */
	public function show(Project $project)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  \App\Models\Project  $project
	 * @return \Illuminate\Http\Response
	 */
	public function edit(Project $project)
	{
		return view('project/edit', [
      "title" => "Edit Project",
      "project" => $project
    ]);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \App\Models\Project  $project
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, Project $project)
	{
		$validatedData = $request->validate([
      'name' => 'required|max:255'
    ]);

    $validatedData['name'] = ucwords($validatedData['name']);

    Project::where('id', $project->id)->update($validatedData);
    return redirect('/project')->with('success', 'Project data successfully updated');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  \App\Models\Project  $project
	 * @return \Illuminate\Http\Response
	 */
	public function destroy(Project $project)
	{
		Project::destroy($project->id);
    return redirect('/project')->with('success', 'Project data successfully deleted');
	}
}
