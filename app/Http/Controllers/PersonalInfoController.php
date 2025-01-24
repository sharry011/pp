<?php

namespace App\Http\Controllers;

use App\Models\PersonalInfo;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class PersonalInfoController extends Controller
{
    public function storePersonalInfo(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:15',
            'password' => 'required|string|min:8',
            'intro_heading' => 'required|string|max:255',
            'intro_detail' => 'required|string',
            'cv' => 'nullable|file|mimes:pdf,doc,docx|max:2048',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        if ($request->hasFile('cv')) {
            $filename = time() . '_' . $request->file('cv')->getClientOriginalName();
            $request->file('cv')->storeAs('cv_uploads', $filename, 'public');
            $validatedData['cv'] = 'cv_uploads/' . $filename;
        }

        if ($request->hasFile('image')) {
            $imageName = time() . '_' . $request->file('image')->getClientOriginalName();
            $request->file('image')->storeAs('images', $imageName, 'public');
            $validatedData['image'] = 'images/' . $imageName;
        }

        $personalInfo = PersonalInfo::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'phone' => $validatedData['phone'],
            'password' => bcrypt($validatedData['password']),
            'intro_heading' => $validatedData['intro_heading'],
            'intro_detail' => $validatedData['intro_detail'],
            'cv' => $validatedData['cv'] ?? null,
            'image' => $validatedData['image'] ?? null,
        ]);

        return response()->json($personalInfo, 201);
    }
    public function edit($id)
    {
        $personalInfo = PersonalInfo::findOrFail($id);
        return view('personalInfo.edit', compact('personalInfo'));
    }

    // Update the personal info
    public function update(Request $request, $id)
    {
        // Validate incoming data
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:15',
            'intro_heading' => 'nullable|string|max:255',
            'intro_detail' => 'nullable|string',
            'password' => 'nullable|string|min:6', // Allow password update
            'cv' => 'nullable|file|mimes:pdf,doc,docx|max:2048', // Validate CV file
        ]);
    
        // Find the personal info record
        $personalInfo = PersonalInfo::findOrFail($id);
    
        // Update the fields
        $personalInfo->name = $validatedData['name'];
        $personalInfo->email = $validatedData['email'];
        $personalInfo->phone = $validatedData['phone'] ?? $personalInfo->phone;
        $personalInfo->intro_heading = $validatedData['intro_heading'] ?? $personalInfo->intro_heading;
        $personalInfo->intro_detail = $validatedData['intro_detail'] ?? $personalInfo->intro_detail;
    
        // Update the password only if provided
        if (!empty($validatedData['password'])) {
            $personalInfo->password = bcrypt($validatedData['password']);
        }
    
        // Handle CV upload
        if ($request->hasFile('cv')) {
            // Delete the old CV if it exists
            if ($personalInfo->cv && \Storage::exists('public/' . $personalInfo->cv)) {
                \Storage::delete('public/' . $personalInfo->cv);
            }
    
            // Store the new CV
            $path = $request->file('cv')->store('cvs', 'public');
            $personalInfo->cv = $path;
        }
    
        // Save the updates
        $personalInfo->save();
    
        // Redirect back with success message
        return redirect()->route('view-portfolio')->with('success', 'Personal Information updated successfully.');
    }
    
}

