<?php

namespace App\Http\Controllers;

use App\Models\Friend;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Container\Attributes\Storage;

class FriendController extends Controller
{
    public function storeFriends(Request $request)
    {
        // Validate and save friends
        $validatedData = $request->validate([
            'friends.*.name' => 'required|string|max:255',
            'friends.*.image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'user_id' => 'required', // Ensure user ID exists
        ]);
        
        foreach ($validatedData['friends'] as $friend) {
            if (isset($friend['image']) && $friend['image']) {
                $filename = time() . '_' . $friend['image']->getClientOriginalName();
                $friend['image']->storeAs('friend_images', $filename, 'public');
                $friend['image'] = 'friend_images/' . $filename;
                $friend['user_id'] = $validatedData['user_id']; 
            }
            Friend::create($friend);
        }
        
        return response()->json(['message' => 'Friends saved successfully!'], 201);
    }

    public function edit($id)
{
    $friend = Friend::findOrFail($id);
    return view('friends.edit', compact('friend'));
}


public function update(Request $request, $id)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
    ]);

    $friend = Friend::findOrFail($id);
    $friend->name = $request->name;

    if ($request->hasFile('image')) {
        // Delete the old image if it exists
        if ($friend->image && \Storage::exists('public/' . $friend->image)) {
            \Storage::delete('public/' . $friend->image);
        }

        $imagePath = $request->file('image')->store('friends', 'public');
        $friend->image = $imagePath;
    }

    $friend->save();

    return redirect()->route('view-portfolio')->with('success', 'Friend updated successfully.');
}
public function destroy($id)
{
    $friend = Friend::findOrFail($id);
    
    // Delete the image file if it exists
    if ($friend->image && \Storage::exists('public/' . $friend->image)) {
        \Storage::delete('public/' . $friend->image);
    }

    $friend->delete();

    return redirect()->route('view-portfolio')->with('success', 'Friend deleted successfully.');
}

}
