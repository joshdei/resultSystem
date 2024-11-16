<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models;
use App\Models\HeadTeacherClass;
use App\Models\Classes;
use App\Models\Student;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
class StudentController extends Controller
{
 
    public function viewStudent()
{
    $students = Student::where('teacher_id', Auth::user()->id)->get();
    return view('teacher.student.view', compact('students'));
}

   
    public function addStudent()
{
    $userId = Auth::id(); // Get authenticated user ID

    // Fetch the teacher's class information along with class details
    $classInfo = HeadTeacherClass::where('teacher_id', $userId)
        ->with('class') // Load related class information
        ->get();

    $classDetails = []; // Initialize an array to store class-arm combinations with class_id

    // Loop through the class information to get the class names, arms, and IDs
    foreach ($classInfo as $info) {
        $class = $info->class;

        if ($class) {
            $className = $class->class_name;
            $classArms = $class->class_arm; // This might already be an array, so no need to decode it

            // Check if class_arm is a string (JSON) and decode it if necessary
            if (is_string($classArms)) {
                $classArms = json_decode($classArms, true); // Decode only if it's a JSON string
            }

            $classId = $class->id; // Get the class ID

            // Loop through arms and store class_id along with class_name and arm
            foreach ($classArms as $arm) {
                $classDetails[] = [
                    'class_id' => $classId, 
                    'class_name' => $className, 
                    'class_arm' => $arm
                ];
            }
        }
    }

    // Pass the class details to the view
    return view('teacher.student.add', compact('classDetails'));
}

    
  
    
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


    public function uploadStudent(Request $request)
{
    $validatedData = $request->validate([
        'student_firstname' => 'required|string|max:255',
        'student_lastname' => 'required|string|max:255',
        'student_identication' => 'required|string|max:255',
        'student_class_details' => 'required|string',
        'gender' => 'required|string',
        
        'student_image' => 'required|image|max:2048',
        
    ]);

    // Extract class details
    $classDetails = explode(',', $request->input('student_class_details'));

    // Ensure all parts are present
    if (count($classDetails) === 3) {
        $classId = $classDetails[0];
        $className = $classDetails[1];
        $classArm = $classDetails[2];
    } else {
        return back()->withErrors(['student_class_details' => 'Invalid class selection.']);
    }

    // Save student details to the database
    $student = new Student();
    $student->firstname = $validatedData['student_firstname'];
    $student->lastname = $validatedData['student_lastname'];
    $student->class_id = $classId; // Save the class ID
    $student->class_name = $className; // Save the class name
    $student->class_arm = $classArm; // Save the class arm
    $student->teacher_id = Auth::user()->id; // Save the class arm
    $student->gender = $validatedData['gender'];
    $student->student_identication = $validatedData['student_identication'];
    // Handle file upload
    if ($request->hasFile('student_image')) {
        $image = $request->file('student_image');
        $path = $image->store('students', 'public');
        $student->profile_image = $path;
    }

    $student->save();

    return redirect()->route('viewStudent')->with('success', 'Student successfully added!');
}

public function editStudent($id)
{
    // Fetch the student by ID
    $student = Student::findOrFail($id);
    $userId = Auth::id(); // Get authenticated user ID

    // Fetch class details (modify this according to your actual model and database structure)
   // Fetch the teacher's class information along with class details
   $classInfo = HeadTeacherClass::where('teacher_id', $userId)
   ->with('class') // Load related class information
   ->get();

$classDetails = []; // Initialize an array to store class-arm combinations with class_id

// Loop through the class information to get the class names, arms, and IDs
foreach ($classInfo as $info) {
   $class = $info->class;

   if ($class) {
       $className = $class->class_name;
       $classArms = $class->class_arm; // This might already be an array, so no need to decode it

       // Check if class_arm is a string (JSON) and decode it if necessary
       if (is_string($classArms)) {
           $classArms = json_decode($classArms, true); // Decode only if it's a JSON string
       }

       $classId = $class->id; // Get the class ID

       // Loop through arms and store class_id along with class_name and arm
       foreach ($classArms as $arm) {
           $classDetails[] = [
               'class_id' => $classId, 
               'class_name' => $className, 
               'class_arm' => $arm
           ];
       }
   }
}

    // Pass the student and class details to the view
    return view('teacher.student.edit', compact('student', 'classDetails'));
}


public function deleteStudent($id)
{
    // Find the student by ID
    $student = Student::findOrFail($id);

    // Delete the student
    $student->delete();

    // Redirect back with a success message
    return redirect()->route('viewStudent')->with('success', 'Student deleted successfully.');
}

public function updateStudent(Request $request, $id)
{
    // Validate the incoming request data
    $validatedData = $request->validate([
        'student_firstname' => 'required|string|max:255',
        'student_lastname' => 'required|string|max:255',
        'student_class_details' => 'required|string',
        'student_image' => 'nullable|image|max:2048',
        'gender' => 'required|string', // Fixed validation for gender
    ]);

    // Find the student by ID
    $student = Student::findOrFail($id);

    // Extract class details
    $classDetails = explode(',', $request->input('student_class_details'));
    if (count($classDetails) === 3) {
        $student->class_id = $classDetails[0];
        $student->class_name = $classDetails[1];
        $student->class_arm = $classDetails[2];
    } else {
        return back()->withErrors(['student_class_details' => 'Invalid class selection.']);
    }

    // Update student details
    $student->firstname = $validatedData['student_firstname'];
    $student->lastname = $validatedData['student_lastname'];
    $student->gender = $validatedData['gender'];

    // Handle the image file upload if a new image is provided
    if ($request->hasFile('student_image')) {
        // Delete the old image if it exists
        if ($student->profile_image && \Storage::disk('public')->exists($student->profile_image)) {
            \Storage::disk('public')->delete($student->profile_image);
        }

        // Save the new image
        $image = $request->file('student_image');
        $path = $image->store('students', 'public');
        $student->profile_image = $path;
    }
    
    $student->save();

    // Redirect back with success message
    return redirect()->route('viewStudent')->with('success', 'Student details updated successfully.');
}


}

