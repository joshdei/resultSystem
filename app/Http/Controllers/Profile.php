<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
class Profile extends Controller
{
    public function profile()
    {
        return view('profile');
    }

    
    public function updateAccount(Request $request)
    {
        $user = Auth::user();
        $request->validate([
            'name' => 'required|string|max:255',
            'lastname' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'email' => 'required|email|max:255',
            'profile_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Validate profile image
        ]);
    
        // Update user details
        $user->name = $request->name;
        $user->lastname = $request->lastname;
        $user->phone = $request->phone;
        $user->email = $request->email;
    
        // Handle profile image upload if it exists
        if ($request->hasFile('profile_image')) {
            // Delete the old profile image if exists
            if ($user->profile_image && Storage::exists('public/' . $user->profile_image)) {
                Storage::delete('public/' . $user->profile_image);
            }
    
            // Store the new image
            $path = $request->file('profile_image')->store('profile_images', 'public');
            $user->profile_image = $path; // Save the new image path to the database
        }
    
        // Save the user
        $user->save();
    
        return back()->with('success', 'Successfully updated');
    }
    
    public function changePassword(Request $request)
    {
        $user = Auth::user();
        $current_password = $request->current_password;
        if (Hash::check($current_password, $user->password)) {
            $newpassword = $request->new_password;
            $renew_password = $request->renew_password;
            if ($newpassword == $renew_password) {
                $user->password = Hash::make($newpassword);
                $user->save();
                echo('Password successfully updated');
            } else {
                echo('New passwords do not match');
            }
        } else {
            echo('Current password is incorrect');
        }
    }
    
    



}
