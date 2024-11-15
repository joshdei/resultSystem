<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\HeadTeacher;
use App\Models\Classes;
use Illuminate\Support\Facades\Hash;
use App\Models\HeadTeacherClass;
use App\Models\Subject;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
class SubjectController extends Controller
{


public function viewsubject(){
    // Fetch classes and subjects for the logged-in user
    $classes = Classes::where('owner_id', Auth::user()->id)->get();
    $subject = Subject::where('owner_id', Auth::user()->id)->get();

    // Pass data to the view
    return view('admin.subject.view', compact('classes', 'subject'));
}


    public function uploadSubject(Request $request)
{
    // Validate the input fields
    $validated = $request->validate([
        'subject_name' => 'required|string|max:255',
        'subject_class_id' => 'required|exists:classes,id', // Ensure the class ID exists in the classes table
    ], [
        'subject_name.required' => 'The subject name is required.',
        'subject_class_id.required' => 'Please select a class.',
        'subject_class_id.exists' => 'The selected class does not exist.',
    ]);

    try {
        // Create a new Subject instance and save data
        $subject = new Subject();
        $subject->subject_name = $request->subject_name;
        $subject->subject_class_id = $request->subject_class_id;
        $subject->owner_id = Auth::user()->id; // Assuming you have an authenticated user
        $subject->save();

        // Redirect back with success message
        return redirect()->back()->with('success', 'Subject added successfully!');
    } catch (\Exception $e) {
        // Log the error and return a message
        \Log::error("Error uploading subject: " . $e->getMessage());
        return redirect()->back()->with('error', 'Something went wrong, please try again.');
    }
}

public function deleteSubject($id)
{
    // Find the subject by ID and ensure it belongs to the authenticated user
    $subject = Subject::where('id', $id)->where('owner_id', Auth::user()->id)->first();

    // If the subject exists and belongs to the authenticated user, delete it
    if ($subject) {
        $subject->delete();
        return redirect()->back()->with('success', 'Subject deleted successfully!');
    }

    // If the subject does not exist or is not owned by the user, return an error
    return redirect()->back()->with('error', 'Subject not found or you are not authorized to delete it.');
}



}
