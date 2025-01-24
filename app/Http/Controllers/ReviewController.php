<?php

namespace App\Http\Controllers;

use App\Models\Review;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    // Display the review form
    public function create()
    {
        return view('reviews.create');
    }

    // Store the review in the database
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:reviews',
            'phone' => 'required|string|max:15',
            'rating' => 'required|integer|min:1|max:5',
            'review_details' => 'required|string',
        ]);

        Review::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'phone' => $validatedData['phone'],
            'rating' => $validatedData['rating'],
            'review_details' => $validatedData['review_details'],
            'status' => 'unchecked', // Default status
        ]);

        return redirect()->route('reviews.create')->with('success', 'Review submitted successfully!');
    }
    public function approveReview($id)
    {
        // Find the review by ID
        $review = Review::findOrFail($id);

        // Update the status to approved (or any status you want)
        $review->status = 'approved';
        $review->save();

        // Redirect back with a success message
        return redirect()->route('view-portfolio')->with('success', 'Review approved successfully.');
    }
}

