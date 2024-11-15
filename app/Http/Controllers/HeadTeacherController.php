<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\HeadTeacher;
use App\Models\Classes;
use Illuminate\Support\Facades\Hash;
use App\Models\HeadTeacherClass;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class HeadTeacherController extends Controller
{
    public function viewheadTeacher()
    {
        $classes = Classes::where('owner_id', Auth::user()->id)->get();
        $teacherInfo = HeadTeacherClass::where('owner_id', Auth::user()->id)->get();

        $check_teache_info = [];
        $teacher_class = [];
        foreach ($teacherInfo as $teacher) {
            $teacher_id = $teacher->teacher_id;
            $teacher_class_id = $teacher->teacher_class_id;
            $user_info = User::where('id', $teacher_id)->first();
            $class_info = Classes::find($teacher_class_id);
            if ($user_info) {
                $check_teache_info[] = $user_info;
                $teacher_class[] = $class_info;
            }
        }
        return view('admin.headteacher.viewheadTeacher', compact('classes', 'teacherInfo', 'check_teache_info', 'teacher_class'));
    }
    public function addHeadTeacher(Request $request)
    {
        $usertype = Auth::user();
        $user = new User();
        $headTeacherClass = new HeadTeacherClass(); // Note: lowercase for consistency

        $request->validate([
            'teacher_firstname' => 'required|string|max:255',
            'teacher_lastname' => 'required|string|max:255',
            'teacher_email' => 'required|email|max:255|unique:users,email',
            'teacher_password' => 'required|string|min:6|confirmed',
            'teacher_password_confirmation' => 'required|string|min:6',
            'teacher_phone' => 'required|string|max:255',
            'teacher_class_id' => 'required|integer',
            'teacher_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($usertype->user_type == 1) {
            if ($request->teacher_password == $request->teacher_password_confirmation) {
                $user->name = $request->teacher_firstname;
                $user->lastname = $request->teacher_lastname;
                $user->email = $request->teacher_email;
                $user->password = bcrypt($request->teacher_password);
                $user->phone = $request->teacher_phone;
                $user->user_type = 2;

                // Handle profile image upload if it exists
                if ($request->hasFile('teacher_image')) {
                    // Delete the old profile image if it exists
                    if ($user->profile_image && Storage::exists('public/' . $user->profile_image)) {
                        Storage::delete('public/' . $user->profile_image);
                    }

                    // Store the new image
                    $path = $request->file('teacher_image')->store('teacher_images', 'public');
                    $user->profile_image = $path;
                }

                // Save the user
                if ($user->save()) {
                    // Assign teacher_class_id and teacher_id to HeadTeacherClass model and associate with the user
                    $headTeacherClass->teacher_class_id = $request->teacher_class_id;
                    $headTeacherClass->teacher_id = $user->id; // Associate the newly created user ID with the teacher_id in HeadTeacherClass
                    $headTeacherClass->owner_id = $usertype->id; // Assuming HeadTeacherClass has a `owner_id` field to associate with User
                    $headTeacherClass->save();
                }

                return redirect()
                    ->route('viewheadTeacher')
                    ->with('success', 'Head Teacher added successfully.');
            } else {
                return redirect()
                    ->back()
                    ->with('error', 'Passwords do not match.');
            }
        } else {
            return redirect()
                ->back()
                ->with('error', 'You are not authorized to add a Head Teacher.');
        }
    }

    public function editTeacher($id)
{
    $user = Auth::user(); // Get the authenticated user

    if ($user->user_type == 1) { // Check if the user is an admin
        if ($id) {
            // Fetch teacher info based on the provided ID
            $teacherInfo = User::find($id);

            if (!$teacherInfo) {
                return back()->with('error', 'Teacher not found.');
            }

            // Fetch the teacher's head teacher classes and associated class information
            $teacherClasses = HeadTeacherClass::where('teacher_id', $id)->get();
            $teacher_class = [];

            foreach ($teacherClasses as $teacherClass) {
                // Retrieve each class by the teacher_class_id from HeadTeacherClass
                $classInfo = Classes::find($teacherClass->teacher_class_id);

                // Add class information to the array if it exists
                if ($classInfo) {
                    $teacher_class[] = $classInfo;
                }
            }

            // Fetch classes owned by the authenticated user
            $classes = Classes::where('owner_id', $user->id)->get();

            // Pass all required data to the view
            return view('admin.headteacher.edit', [
                'teacherInfo' => $teacherInfo,
                'classes' => $classes,
                'teacher_class' => $teacher_class,
            ]);
        } else {
            return back()->with('error', 'Invalid teacher ID.');
        }
    } elseif ($user->user_type == 2) { // Check if the user is a teacher
        return view('teacher.dashboard');
    } else {
        return view('not_verified'); // For other user types
    }

    return view('auth.login'); // Fallback, though this line is unreachable
}

public function updateTeacherAccount(Request $request)
{
    // Validate form data
    $request->validate([
        'teacher_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        'name' => 'required|string|max:255',
        'lastname' => 'required|string|max:255',
        'teacher_class_id' => 'required|exists:classes,id',
        'teacher_phone' => 'required|string|max:15',
        'teacher_email' => 'required|email|max:255|unique:users,email,',
        'password' => 'nullable|string|min:8|confirmed',
    ]);

    // Find the teacher's user record
    $teacher = User::find($request->teacherId);

    if (!$teacher) {
        return redirect()->back()->withErrors(['error' => 'Teacher not found.']);
    }

    // Update teacher information
    $teacher->name = $request->name;
    $teacher->lastname = $request->lastname;
    $teacher->phone = $request->teacher_phone;
    $teacher->email = $request->teacher_email;

    // Handle profile image upload if provided
    if ($request->hasFile('teacher_image')) {
        // Delete old image if exists
        if ($teacher->profile_image) {
            Storage::delete('public/' . $teacher->profile_image);
        }

        // Store new image
        $teacher->profile_image = $request->file('teacher_image')->store('profile_images', 'public');
    }

    // Update password if provided
    if ($request->filled('password')) {
        $teacher->password = Hash::make($request->password);
    }

    // Save teacher data
    $teacher->save();

    // Update the teacher's class in HeadTeacherClass
    $headTeacherClass = HeadTeacherClass::where('teacher_id', $teacher->id)->first();
    if ($headTeacherClass) {
        $headTeacherClass->teacher_class_id = $request->teacher_class_id;
        $headTeacherClass->save();
    }

    return redirect()
                ->back();
}

}
