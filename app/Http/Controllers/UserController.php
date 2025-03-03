<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function profile()
    {
        return view('user.profile'); // Create this view
    }

    public function settings()
    {
        return view('user.settings'); // Create this view
    }

    public function management()
    {
        // Fetch users for management
        $users = User::all(); // Adjust based on your User model
        return view('user.management', compact('users')); // Create this view
    }
}