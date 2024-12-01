<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models;
use App\Models\AssignSession;
use App\Models\AssignClassTeacher;
use App\Models\AssignHeadClassTeacher;
use App\Models\AssignResumption;
use App\Models\Classes;
use App\Models\Subject;
use App\Models\Mark;
use App\Models\Student;
use App\Models\StudentMark;
use App\Models\HeadTeacherClass;
use App\Models\Term;
use App\Models\SchoolOpening;
use App\Models\Studentmarks;
use App\Models\StoreStudentScores;
use Illuminate\Support\Facades\Storage;

use Illuminate\Support\Facades\Auth;
class MarksController extends Controller
{
    public function viewMarks()
    {
        $userId = Auth::user()->id;
        $marks = Mark::where('owner_id', $userId)->get();
        return view('admin.mark.view', compact('marks'));
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
        return redirect()
            ->back()
            ->with('success', 'Marks uploaded successfully!');
    }

    public function deleteMarks($id)
    {
        // Find the subject by ID and ensure it belongs to the authenticated user
        $subject = Mark::where('id', $id)
            ->where('owner_id', Auth::user()->id)
            ->first();

        // If the subject exists and belongs to the authenticated user, delete it
        if ($subject) {
            $subject->delete();
            return redirect()
                ->back()
                ->with('success', 'Subject deleted successfully!');
        }

        // If the subject does not exist or is not owned by the user, return an error
        return redirect()
            ->back()
            ->with('error', 'Subject not found or you are not authorized to delete it.');
    }

    public function viewOthers()
    {
        return view('admin.others.others');
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
            $hasMarks = isset($validated['first_test_marks'][$studentId]) || isset($validated['second_test_marks'][$studentId]) || isset($validated['exam_marks'][$studentId]);

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
        return redirect()
            ->route('viewStudentMarks')
            ->with('success', 'Marks uploaded successfully!');
    }

    public function viewStudentMarks()
    {
        // Fetch marks with related student details
        $studentMarks = StudentMark::where('teacher_id', Auth::user()->id)
            ->with('student') // Eager load the related student
            ->get();

        return view('teacher.mark.viewStudentMarks', compact('studentMarks'));
    }

    public function addMarks($studentIndex = 0)
    {
        $userId = Auth::user()->id;
        $teacherOwnerId = HeadTeacherClass::where('teacher_id', $userId)->first();

        if (!$teacherOwnerId) {
            return redirect()
                ->back()
                ->with('error', 'No owner ID found for this teacher.');
        }

        $getSession = AssignSession::where('owner_id', $teacherOwnerId->owner_id)->get();
        $getClass = Classes::where('id', $teacherOwnerId->teacher_class_id)->get();
        $getSubjectOfTheClass = Subject::where('subject_class_id', $teacherOwnerId->teacher_class_id)->get();

        // Fetch all students for the teacher
        $students = Student::where('teacher_id', $userId)->get();

        // Get the specific student to display
        $currentStudent = $students[$studentIndex] ?? null;

        if (!$currentStudent) {
            return redirect()
                ->back()
                ->with('error', 'No more students available.');
        }

        return view('teacher.mark.add', compact('students', 'currentStudent', 'getSubjectOfTheClass', 'getSession', 'getClass', 'studentIndex'));
    }

    public function addStudentmarks($id)
    {
        if ($id) {
            // Retrieve the student record
            $student = Student::find($id);
    
            if ($student) {
                // Extract student and related data
                $firstname = $student->firstname;
                $student_id = $student->id;
                $lastname = $student->lastname;
                $gender = $student->gender;
                $student_identication = $student->student_identication; // Corrected typo
                $class_id = $student->class_id;
                $class_name = $student->class_name;
                $class_arm = $student->class_arm;
                $teacherId = $student->teacher_id;
    
                // Retrieve class size
                $class = Classes::find($class_id);
                $class_size = $class ? $class->class_size : null;
                $ownerId = $class ? $class->owner_id : null; // Ensure class is found before accessing
    
                // Retrieve school sessions for the teacher
                $schoolSession = AssignSession::where('owner_id', $ownerId)->get();
                $term = Term::where('owner_id', $ownerId)->get();
                $SchoolOpening = SchoolOpening::where('owner_id', $ownerId)->get();
    
                // Retrieve subjects for the class
                $Subject = Subject::where('subject_class_id', $class_id)->get();
                $AssignClassTeacher = AssignClassTeacher::where('owner_id',$ownerId)->get();

                $AssignHeadClassTeacher = AssignHeadClassTeacher::where('owner_id',$ownerId)->get();
                // Pass all details to the view
                $AssignResumption = AssignResumption::where('owner_id',$ownerId)->get();
                return view('teacher.mark.addscore', compact(
                    'firstname', 
                    'lastname', 
                    'gender', 
                    'student_identication', 
                    'class_id', 
                    'student_id',
                    'class_name', 
                    'class_arm', 
                    'class_size',
                    'schoolSession',
                    'term',
                    'SchoolOpening',
                    'Subject',
                    'AssignHeadClassTeacher',
                    'AssignClassTeacher',
                    'AssignResumption',
                ));
            } else {
                // Redirect if the student doesn't exist
                return redirect()->back()->with('error', 'Student not found.');
            }
        }
    
        // Redirect if no ID provided
        return redirect()->back()->with('error', 'Invalid request.');
    }
    public function submitMarks(Request $request)
    {
        // Validate incoming data
        $validated = $request->validate([
            'school_session' => 'required|string|max:255',
            'student_id' => 'required|string|max:255',
            'class_id' => 'required|string|max:255',
            'term' => 'required|string|max:50',
            'attendance' => 'required|integer',
            'marks' => 'required|array', // Expect marks as an array
            'class_participation' => 'required|integer',
            'school_attendance' => 'required|integer',
            'concentration' => 'required|integer',
            'attitude_to_property' => 'required|integer',
            'assignment' => 'required|integer',
            'cleanliness' => 'required|integer',
            'punctuality' => 'required|integer',
            'general_conduct' => 'required|integer',
            'class_remark' => 'required|string|max:500',
            'head_remark' => 'required|string|max:500',
            'outstanding_fees' => 'required|integer',
            'next_term_fees' => 'required|integer',
        ]);
    
        try {
            // Update existing data or create new record
            $data = Studentmarks::updateOrCreate(
                [
                    'student_id' => $validated['student_id'], // Search condition
                    'class_id' => $validated['class_id'],
                    'term' => $validated['term'],
                ],
                [
                    'teacher_id' => Auth::user()->id,
                    'school_session' => $validated['school_session'],
                    'attendance' => $validated['attendance'],
                    'marks' => json_encode($validated['marks']), // Convert array to JSON
                    'class_participation' => $validated['class_participation'],
                    'school_attendance' => $validated['school_attendance'],
                    'concentration' => $validated['concentration'],
                    'attitude_to_property' => $validated['attitude_to_property'],
                    'assignment' => $validated['assignment'],
                    'cleanliness' => $validated['cleanliness'],
                    'punctuality' => $validated['punctuality'],
                    'general_conduct' => $validated['general_conduct'],
                    'class_remark' => $validated['class_remark'],
                    'head_remark' => $validated['head_remark'],
                    'outstanding_fees' => $validated['outstanding_fees'],
                    'next_term_fees' => $validated['next_term_fees'],
                ]
            );
    

             // Step 2: Calculate the total score from the marks
             $marks = $validated['marks']; // This is an array
             $totalScore = 0;
     
             foreach ($marks as $subjectId => $subjectMarks) {
                 $firstTest = $subjectMarks['first_test'] ?? 0;
                 $secondTest = $subjectMarks['second_test'] ?? 0;
                 $exam = $subjectMarks['exam'] ?? 0;
     
                 $totalScore += $firstTest + $secondTest + $exam;
             }
     
             // Step 3: Divide the total score by 2
             $finalScore = $totalScore;
     
             // Step 4: Store the result in the StoreStudentScores table
             StoreStudentScores::updateOrCreate(
                 [
                     'student_id' => $validated['student_id'], // Ensure uniqueness for student
                     'class_id' => $validated['class_id'],
                 ],
                 [
                     'teacher_id' => Auth::user()->id,
                     'marks' => $finalScore, // Store the divided score
                 ]
             );

            // Provide appropriate feedback
            if ($data->wasRecentlyCreated) {
                return redirect()->back()->with('success', 'Student marks have been successfully submitted.');
            } else {
                return redirect()->back()->with('success', 'Existing student marks have been successfully updated.');
            }
        } catch (\Exception $e) {
            // Log any exception for debugging purposes
            \Log::error('Error saving/updating student marks: ' . $e->getMessage());
    
            return redirect()->back()->withErrors('An unexpected error occurred. Please contact support.');
        }
    }
    
}
 