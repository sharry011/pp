<?php

namespace App\Http\Controllers;

use App\Models\PersonalInfo;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
// use Illuminate\Support\Facades\Auth;
class AuthController extends Controller
{
    // Show the login form
    public function showLoginForm()
    {
        return view('login');
    }

    // Handle login request
    public function login(Request $request)
    {
        // Validate the login credentials
        $validatedData = $request->validate([
            'email' => 'required|email',
            'password' => 'required|string|min:8',
        ]);
        
        // Check if user exists with the given email
        $user = PersonalInfo::where('email', $validatedData['email'])->first();
        
        if ($user && Hash::check($validatedData['password'], $user->password)) {
            // If password matches, log in the user
            Auth::login($user);
            
            // Access the authenticated user's ID
            $userId = Auth::guard('web')->id(); // Use the 'web' guard if it's the default for session-based authentication

            
            // You can pass this ID to the view or use it for other purposes
            return redirect()->route('viewPortfolio')->with('user_id', $userId);
        }
        
        // If login fails, redirect back with error
        return back()->withErrors(['email' => 'Invalid credentials'])->withInput();
    }
    

    // Handle user logout
    public function logout()
    {
        Auth::logout();  // Log out the user
        return redirect()->route('login'); // Redirect to the login page
    }
}
