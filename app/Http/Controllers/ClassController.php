<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models;
use App\Models\Classes;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
class ClassController extends Controller
{
    public function viewClass()
{
    $userId = Auth::user()->id;
    $classes = Classes::where('owner_id', $userId)->get(); 

    return view('admin.class.view', compact('classes'));
}


public function addClass(Request $request)
{
    // Validate the input data
    $user = Auth::user(); // Get the authenticated user
    $request->validate([
        'class_name' => 'required|string|max:255',
        'class_arm' => 'required|array',  // Expect an array of selected arms
        'class_arm.*' => 'string|max:1',  // Each arm should be a single character (A-Z)
        'class_size' => 'required|integer|min:1',
    ]);

    // Create a new class instance
    $class = new Classes();
    $class->class_name = $request->class_name;
    $class->class_size = $request->class_size;
    $class->owner_id = $user->id;
    // Store class_arm as a JSON array in the database
    $class->class_arm = $request->class_arm;  

    // Save the class to the database
    $class->save();

    // Redirect back with success message
    return back()->with('success', 'Class added successfully!');
}


public function editClass($id)
{
    $class = Classes::findOrFail($id);
    
    // If class_arm is a string, decode it. Otherwise, use it as is.
    if (is_string($class->class_arm)) {
        $class->class_arm = json_decode($class->class_arm, true);  // Decode JSON to array
    }
    
    return view('admin.class.edit', compact('class'));
}


public function updateClass(Request $request, $id)
{
    $request->validate([
        'class_name' => 'required|string|max:255',
        'class_arm' => 'required|array',
        'class_size' => 'required|integer',
    ]);

    $class = Classes::findOrFail($id);
    $class->class_name = $request->class_name;
    $class->class_arm = $request->class_arm; // assuming `class_arm` is stored as an array in JSON
    $class->class_size = $request->class_size;

    $class->save();

    return redirect()->route('viewClass')->with('success', 'Class  successfully.');
}


public function deleteClass($id)
{
    $class = Classes::findOrFail($id);
    $class->delete();

    return redirect()->route('viewClass')->with('success', 'Class deleted successfully.');
}

    
}
