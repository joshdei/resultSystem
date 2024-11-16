<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models;
use App\Models\Subject;
use App\Models\Mark;
use App\Models\Student;
use App\Models\StudentMark;
use App\Models\HeadTeacherClass;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
class MarksController extends Controller
{
    public function viewMarks(){
        $userId = Auth::user()->id;
        $marks = Mark::where('owner_id', $userId)->get();
        return view('admin.mark.view',compact('marks'));
    }

    public function uploadMarks(Request $request)
{
   
    $validated = $request->validate([
        'first_test_marks' => 'required|integer|min:1|max:100',
        'second_test_marks' => 'required|integer|min:1|max:100',
        'exam_marks' => 'required|integer|min:1|max:100',
    ]);

    $marks = new Mark();
    $marks->first_test_marks = $validated['first_test_marks'];
    $marks->second_test_marks = $validated['second_test_marks'];
    $marks->exam_marks = $validated['exam_marks'];
    $marks->owner_id = Auth::user()->id; 
    $marks->save();
    return redirect()->back()->with('success', 'Marks uploaded successfully!');
}



public function deleteMarks($id)
{
    // Find the subject by ID and ensure it belongs to the authenticated user
    $subject = Mark::where('id', $id)->where('owner_id', Auth::user()->id)->first();

    // If the subject exists and belongs to the authenticated user, delete it
    if ($subject) {
        $subject->delete();
        return redirect()->back()->with('success', 'Subject deleted successfully!');
    }

    // If the subject does not exist or is not owned by the user, return an error
    return redirect()->back()->with('error', 'Subject not found or you are not authorized to delete it.');
}

public function viewOthers(){
    return view('admin.others.others');
}

 
public function addMarks()
{
    // Get the authenticated user's ID
    $userId = Auth::user()->id;

    // Get the owner_id associated with the teacher (ensure the 'HeadTeacherClass' model exists and is correctly defined)
    $teacherOwnerId = HeadTeacherClass::where('teacher_id', $userId)->first(); 
 
    // Check if the teacher has an associated owner_id
    if (!$teacherOwnerId) {
        return redirect()->back()->with('error', 'No owner ID found for this teacher.');
    }

    // Fetch the marks based on the owner_id (it should match with the teacher's associated students)
    $marks = Mark::where('owner_id', $teacherOwnerId->owner_id)->get();
    $getSubjectoftheclass = Subject::where('subject_class_id',$teacherOwnerId->teacher_class_id)->get();
    // Fetch the students associated with this teacher
    $students = Student::where('teacher_id', $userId)->get();

    // Pass the data to the view
    return view('teacher.mark.add', compact('marks', 'students','getSubjectoftheclass'));
}

public function uploadStudentMarks(Request $request)
{
    // Validate the input data for all students
    $validated = $request->validate([
        'first_test_marks' => 'array',
        'first_test_marks.*' => 'nullable|integer|min:1|max:10', // Allow nullable values
        'second_test_marks' => 'array',
        'second_test_marks.*' => 'nullable|integer|min:1|max:20',
        'exam_marks' => 'array',
        'exam_marks.*' => 'nullable|integer|min:1|max:70',
        'student_ids' => 'required|array',
        'student_ids.*' => 'required|integer', // Validate student IDs
    ]);

    foreach ($validated['student_ids'] as $studentId) {
        // Check if marks are provided for the student
        $hasMarks = isset($validated['first_test_marks'][$studentId]) ||
                    isset($validated['second_test_marks'][$studentId]) ||
                    isset($validated['exam_marks'][$studentId]);

        if ($hasMarks) {
            // Find the existing record or create a new one
            $marks = StudentMark::firstOrNew([
                'student_id' => $studentId,
                'teacher_id' => Auth::user()->id,
            ]);

            // Update only the provided marks
            if (isset($validated['first_test_marks'][$studentId])) {
                $marks->student_first_test_marks = $validated['first_test_marks'][$studentId];
            }
            if (isset($validated['second_test_marks'][$studentId])) {
                $marks->student_second_test_marks = $validated['second_test_marks'][$studentId];
            }
            if (isset($validated['exam_marks'][$studentId])) {
                $marks->student_exam_marks = $validated['exam_marks'][$studentId];
            }

            // Save the record
            $marks->save();
        }
    }

    // Redirect back with a success message
    return redirect()->route('viewStudentMarks')->with('success', 'Marks uploaded successfully!');
}


public function viewStudentMarks()
{
    // Fetch marks with related student details
    $studentMarks = StudentMark::where('teacher_id', Auth::user()->id)
        ->with('student') // Eager load the related student
        ->get();

    return view('teacher.mark.viewStudentMarks', compact('studentMarks'));
}


}
