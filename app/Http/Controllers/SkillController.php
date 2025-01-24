<?php

namespace App\Http\Controllers;

use App\Models\Skill;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SkillController extends Controller
{
    public function storeSkills(Request $request)
    {
        // Dump the request data to check if everything is coming correctly
        // dd($request->all());
    
        // Validate the input data
        $validatedData = $request->validate([
            'skills.*.name' => 'required|string|max:255',
            'skills.*.percentage' => 'required|integer|between:0,100',
            'user_id' => 'required', // Ensure the user ID exists in the users table
        ]);
    
        // Attach user_id to each skill and save
        foreach ($validatedData['skills'] as $skill) {
            $skill['user_id'] = $validatedData['user_id']; // Add user_id to the skill
            Skill::create($skill); // Create skill with user_id
        }
    
        return response()->json(['message' => 'Skills saved successfully!'], 201);
    }
    public function edit($id)
    {
        $skill = Skill::findOrFail($id); // Fetch the skill by ID
        return view('skills.edit', compact('skill'));
    }

    // Update the skill
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'percentage' => 'required|integer|min:0|max:100',
        ]);

        $skill = Skill::findOrFail($id);
        $skill->update($validatedData);

        return redirect()->route('view-portfolio')->with('success', 'Skill updated successfully.');
    }
    public function destroy($id)
    {
        $skill = Skill::findOrFail($id);
        $skill->delete();

        return redirect()->route('view-portfolio')->with('success', 'Skill deleted successfully.');
    }
}
