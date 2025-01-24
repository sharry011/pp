<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProjectController extends Controller
{
    public function store(Request $request)
    {
        // Dump the request data to check the 'user_id'
        // dd($request->all());  // This will display all the incoming request data
    
        // Validate the input data
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'client' => 'nullable|string|max:255',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date',
            'project_url' => 'nullable|url',
            'cost' => 'nullable|numeric|min:0',
            'user_id' => 'required', // Ensure user ID exists
        ]);
    
        // Create the project with the user_id
        $project = Project::create($validatedData);
        // dd($project);  // Check if the project is being created and saved

        // Return a response (e.g., success message)
        return response()->json(['message' => 'Project created successfully!', 'project' => $project], 201);
    }
    public function edit($id)
{
    $project = Project::findOrFail($id);
    return view('projects.edit', compact('project'));
}
public function update(Request $request, $id)
{
    $request->validate([
        'title' => 'required|string|max:255',
        'description' => 'nullable|string',
        'client' => 'nullable|string',
        'start_date' => 'nullable|date',
        'end_date' => 'nullable|date',
        'project_url' => 'nullable|url',
        'cost' => 'nullable|numeric',
    ]);

    $project = Project::findOrFail($id);
    $project->title = $request->title;
    $project->description = $request->description;
    $project->client = $request->client;
    $project->start_date = $request->start_date;
    $project->end_date = $request->end_date;
    $project->project_url = $request->project_url;
    $project->cost = $request->cost;

    $project->save();

    return redirect()->route('view-portfolio')->with('success', 'Project updated successfully.');
}
public function destroy($id)
{
    $project = Project::findOrFail($id);
    $project->delete();

    return redirect()->route('view-portfolio')->with('success', 'Project deleted successfully.');
}

}
