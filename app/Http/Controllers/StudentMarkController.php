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


class StudentMarkController extends Controller
{
   
    public function editStudentMark($id)
{
    $studentMark = StudentMark::with('student')->findOrFail($id); // Include student relationship if needed
    return view('teacher.mark.editStudentMark', compact('studentMark'));
}


    public function updateStudentMark(Request $request, $id)
{
    $validated = $request->validate([
        'student_first_test_marks' => 'required|integer|min:0|max:100',
        'student_second_test_marks' => 'required|integer|min:0|max:100',
        'student_exam_marks' => 'required|integer|min:0|max:100',
    ]);

    $studentMark = StudentMark::findOrFail($id);
    $studentMark->update([
        'student_first_test_marks' => $validated['student_first_test_marks'],
        'student_second_test_marks' => $validated['student_second_test_marks'],
        'student_exam_marks' => $validated['student_exam_marks'],
    ]);

    return redirect()->route('viewStudentMarks')->with('success', 'Student mark updated successfully!');
}
public function deleteStudentMark($id)
{
    $studentMark = StudentMark::findOrFail($id);
    $studentMark->delete();

    return redirect()->route('viewStudentMarks')->with('success', 'Student mark deleted successfully!');
}
}
