<?php

namespace App\Http\Controllers;

use App\Models\Education;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class EducationController extends Controller
{
    
    public function storeEducation(Request $request)
    {
        try {
            // Validate and save educations
            $validatedData = $request->validate([
                'educations' => 'required|array',
                'educations.*.detail' => 'required|string',
                'educations.*.start_year' => 'required|string', // This should now match
                'educations.*.end_year' => 'required|string', // This should now match
                'educations.*.image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
                'user_id' => 'required', // Ensure user ID exists
            ]);
            
            foreach ($validatedData['educations'] as $education) {
                // Handle the image upload if it exists
                if (isset($education['image'])) {
                    $filename = time() . '_' . $education['image']->getClientOriginalName();
                    $education['image']->storeAs('education_images', $filename, 'public');
                    $education['image'] = 'education_images/' . $filename; // Set the path for the image
                    $education['user_id'] = $validatedData['user_id'];  // Set the path for the image
                }
    
                // Create the education record in the database
                Education::create($education);
            }
    
            return response()->json(['message' => 'Educations saved successfully!'], 201);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Error saving educations: ' . $e->getMessage()], 500);
        }
    }
    public function edit($id)
{
    $education = Education::findOrFail($id);
    return view('educations.edit', compact('education'));
}
public function update(Request $request, $id)
{
    // Validate the incoming data
    $validatedData = $request->validate([
        'detail' => 'required|string|max:255',
        'start_year' => 'required|integer|min:1900|max:' . date('Y'),
        'end_year' => 'nullable|integer|min:1900|max:' . date('Y'),
        'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
    ]);

    // Fetch the education record by ID or fail
    $education = Education::findOrFail($id);

    // Update the education record
    $education->detail = $validatedData['detail'];
    $education->start_year = $validatedData['start_year'];
    $education->end_year = $validatedData['end_year'] ?? null;

    // Handle image upload
    if ($request->hasFile('image')) {
        // Delete the old image if it exists
        if ($education->image && \Storage::exists('public/' . $education->image)) {
            \Storage::delete('public/' . $education->image);
        }

        // Store the new image
        $imagePath = $request->file('image')->store('educations', 'public');
        $education->image = $imagePath;
    }

    // Save the updated education record to the database
    $education->save();

    // Redirect back with a success message
    return redirect()->route('view-portfolio')->with('success', 'Education updated successfully.');
}


public function destroy($id)
{
    $education = Education::findOrFail($id);
    
    // Delete the image file if it exists
    if ($education->image && \Storage::exists('public/' . $education->image)) {
        \Storage::delete('public/' . $education->image);
    }

    $education->delete();

    return redirect()->route('view-portfolio')->with('success', 'Education deleted successfully.');
}

}
