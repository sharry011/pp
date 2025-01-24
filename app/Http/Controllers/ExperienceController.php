<?php

namespace App\Http\Controllers;

use App\Models\Experience;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Container\Attributes\Storage;

class ExperienceController extends Controller
{
    public function storeExperience(Request $request)
    {
        // Ensure the user is authenticated
     // Get the authenticated user's ID
    
        // Validate the input data
        $validatedData = $request->validate([
            'experiences.*.image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'experiences.*.heading' => 'required|string|max:255',
            'experiences.*.detail' => 'required|string',
            'user_id' => 'required', 
        ]);
    
        foreach ($validatedData['experiences'] as $experience) {
            // Handle the image upload if it exists
            if (isset($experience['image']) && $experience['image'] instanceof \Illuminate\Http\UploadedFile) {
                $filename = time() . '_' . $experience['image']->getClientOriginalName();
                $experience['image']->storeAs('experience_images', $filename, 'public');
                $experience['image'] = 'experience_images/' . $filename; // Set the path for the image
                $experience['user_id'] = $validatedData['user_id']; // Set the path for the image
            }
    
            // Add the authenticated user's ID to the experience data
            // $experience['user_id'] = $userId;
    
            // Create the experience record in the database
            Experience::create($experience);
        }
    
        return response()->json(['message' => 'Experiences saved successfully!'], 201);
    }
    public function edit($id)
{
    $experience = Experience::findOrFail($id);
    return view('experiences.edit', compact('experience'));
}
public function update(Request $request, $id)
{
    $request->validate([
        'heading' => 'required|string|max:255',
        'detail' => 'required|string',
        'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
    ]);

    $experience = Experience::findOrFail($id);
    $experience->heading = $request->heading;
    $experience->detail = $request->detail;

    if ($request->hasFile('image')) {
        $imagePath = $request->file('image')->store('experiences', 'public');
        $experience->image = $imagePath;
    }

    $experience->save();

    return redirect()->route('view-portfolio')->with('success', 'Experience updated successfully.');
}
public function destroy($id)
{
    $experience = Experience::findOrFail($id);
    
    // Delete the image file if it exists
    if ($experience->image && \Storage::exists('public/' . $experience->image)) {
        \Storage::delete('public/' . $experience->image);
    }

    $experience->delete();

    return redirect()->route('view-portfolio')->with('success', 'Experience deleted successfully.');
}

}
