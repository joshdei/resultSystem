<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{
    User,
    Student,
    Mark,
    School,
    Subject,
    Studentmarks,
    Term,
    Classes,
    AssignSesssion,
    AssignResumption,
    AsssignClassTeacher,
    AssignHeadClassTeacher,
};

class StudentResult extends Controller
{
    public function singleStudentResult($id)
    {
        // Find the student by ID
        $student = Student::find($id);
        
        // Check if student exists
        if ($student) {
            // Get the class_id for the student
            $studentClassId = $student->class_id;
            
            // Get all students in the same class
            $studentsInClass = Student::where('class_id', $studentClassId)->get();
            
            // Get the total number of students in the same class
            $totalStudentsInClass = $studentsInClass->count();
            
            // Fetch the student's marks from the 'student_marks' table
            $studentMark = Studentmarks::where('student_id', $student->id)->first(); // Use first() to get a single record
            
            if ($studentMark) {
                $marks = json_decode($studentMark->marks, true);
                $subjectNames = [];
                foreach ($marks as $subjectId => $markDetails) {
                    $subject = Subject::find($subjectId);
                    if ($subject) {
                        $subjectNames[$subjectId] = $subject->subject_name;
                    } else {
                        $subjectNames[$subjectId] = 'Unknown Subject'; 
                    }
                }
            } else {
                $marks = null;
                $subjectNames = [];
            }
    
            // Fetch marks for all students in the same class
            $studentsMarks = [];
            foreach ($studentsInClass as $classmate) {
                $classmateMarks = Studentmarks::where('student_id', $classmate->id)->first();
                if ($classmateMarks) {
                    $studentsMarks[$classmate->id] = json_decode($classmateMarks->marks, true);
                } else {
                    $studentsMarks[$classmate->id] = null; // No marks available for this student
                }
            }
    
            // Return the view with the data
            return view('teacher.student.singleresult', compact('marks', 'subjectNames', 'student', 'studentsInClass', 'studentsMarks', 'totalStudentsInClass'));
        } else {
            // Student not found
            return response()->json(['message' => 'Student not found'], 404);
        }
    }
    
}
