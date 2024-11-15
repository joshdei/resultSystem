<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class Backdoor extends Controller
{
    public function access()
    {
        $user = Auth::user(); // Get the authenticated user
    
        if (!$user) {
            // Redirect to the login view if not authenticated
            return view('auth.login');
        }
    
        // Check user type and direct to appropriate dashboard
        if ($user->user_type == 1) {
            return view('admin.dashboard');
        } elseif ($user->user_type == 2) {
            return view('teacher.dashboard');
        } else {
            return view('not_verified'); // For unverified or other user types
        }
    }
    
}
