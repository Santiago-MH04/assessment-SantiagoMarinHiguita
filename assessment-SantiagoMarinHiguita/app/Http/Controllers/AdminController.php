<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
        //Admin is also a permission that can be granted to people who, can also register new users
    public function registerUser(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|unique_except_admin_email',
            'password' => 'required|string|min:8|confirmed',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            // ... other fields as needed
        ]);

        // Redirect or display a success message
        return redirect()->back()->with('success', 'User registered successfully.');
    }
}
