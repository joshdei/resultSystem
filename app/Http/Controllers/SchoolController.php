<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models;
use App\Models\School;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
class SchoolController extends Controller
{
    public function schoolinformation()
    {
        return view('admin.school.information');
    }

    public function uploadSchoolData(Request $request)
    {
        $user = Auth::user();
        $school = new School();
        $request->validate([
            'school_name' => 'required|string|max:255',
            'school_motto' => 'required|string|max:255',
            'school_address' => 'required|string|max:255',
            'school_phone' => 'required|string|max:255',
            'school_email' => 'required|email|max:255',
            'school_logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Validate profile image
        ]);

        // Update user details

        if ($user->user_type == 1) {
            $school->school_name = $request->school_name;
            $school->school_motto = $request->school_motto;
            $school->school_address = $request->school_address;
            $school->school_phone = $request->school_phone;
            $school->owner_id = $user->id;
            $school->school_email = $request->school_email;
            // Handle profile image upload if it exists
            if ($request->hasFile('school_logo')) {
                // Delete the old profile image if exists
                if ($school->school_logo && Storage::exists('public/' . $school->school_logo)) {
                    Storage::delete('public/' . $school->school_logo);
                }

                // Store the new image
                $path = $request->file('school_logo')->store('school_logo', 'public');
                $school->school_logo = $path; // Save the new image path to the database
            }

            // Save the user
            $school->save();

            return redirect()->route('view_school_information')->with('success', 'Class  successfully.');
        } else {
            echo 'you are not Admin';
        }
    }

    public function viewSchoolInformation()
    {
        $userId = Auth::user()->id;
        $schoolInfo = School::join('users', 'schools.owner_id', '=', 'users.id')
            ->where('users.id', $userId)
            ->select('schools.*', 'users.name as firstname', 'users.lastname as lastname', 'users.email as email') // specify the fields you need
            ->first(); // use first() if expecting only one record

        return view('admin.school.view', compact('schoolInfo'));
    }

    public function updateSchoolAccount(Request $request)
    {
        $user = Auth::user();
    
        // Validate form inputs
        $request->validate([
            'school_name' => 'required|string|max:255',
            'school_motto' => 'required|string|max:255',
            'school_address' => 'required|string|max:255',
            'school_phone' => 'required|string|max:255',
            'school_email' => 'required|email|max:255',
            'school_logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
    
        // Check if the user is an admin
        if ($user->user_type == 1) {
            // Retrieve the existing school record associated with the user
            $school = School::where('owner_id', $user->id)->first();
    
            if (!$school) {
                return back()->with('error', 'School information not found');
            }
    
            // Update school details
            $school->school_name = $request->school_name;
            $school->school_motto = $request->school_motto;
            $school->school_address = $request->school_address;
            $school->school_phone = $request->school_phone;
            $school->school_email = $request->school_email;
    
            // Handle school logo upload if it exists
            if ($request->hasFile('school_logo')) {
                // Delete the old logo if it exists
                if ($school->school_logo && Storage::exists('public/' . $school->school_logo)) {
                    Storage::delete('public/' . $school->school_logo);
                }
    
                // Store the new logo
                $path = $request->file('school_logo')->store('school_logo', 'public');
                $school->school_logo = $path;
            }
    
            // Save the updated school information
            $school->save();
    
            return back()->with('success', 'School information successfully updated');
        } else {
            return back()->with('error', 'You are not authorized to perform this action');
        }
    }
    

}
