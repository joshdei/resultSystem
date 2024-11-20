<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{User, Student, Mark, School, Subject, Studentmarks, Term, Classes, AssignSesssion, AssignResumption, AsssignClassTeacher, AssignHeadClassTeacher, HeadTeacherClass, AssignSession, AssignClassTeacher, SchoolOpening};

class StudentResult extends Controller
{
    public function singleStudentResult($id)
    {
        $student = Student::find($id);
        if ($student) {
            $studentClassId = $student->class_id;
            $studentsInClass = Student::where('class_id', $studentClassId)->get();
            $class = Classes::find($studentClassId);
            $owner_id = $class ? $class->owner_id : null;
            $school_information = $owner_id ? School::where('owner_id', $owner_id)->get() : collect();
            $resumptionDate = $owner_id ? AssignResumption::where('owner_id', $owner_id)->value('date') : 'Not assigned';
            $session = $owner_id ? AssignSession::where('owner_id', $owner_id)->value('session') : 'Not assigned';
            $className = $class ? $class->class_name : 'Unknown';
            $classSize = $class ? $class->class_size : 'Unknown';
            $classArm = $student->class_arm ?? ($student->class->class_arm ?? 'Unknown');
            $term = $owner_id ? Term::where('owner_id', $owner_id)->value('term') : 'Not assigned';
            $daysSchoolOpened = $owner_id ? SchoolOpening::where('owner_id', $owner_id)->value('number') : 'Not assigned';
            $studentMark = Studentmarks::where('student_id', $student->id)->first();
            $attendance = $studentMark ? $studentMark->attendance : 'Not recorded';
            $totalStudentsInClass = $studentsInClass->count();
            $classAverages = [];
            foreach ($studentsInClass as $classmate) {
                $classmateMarks = Studentmarks::where('student_id', $classmate->id)->first();
                $classmateMarks = Studentmarks::where('student_id', $classmate->id)->first();
                if ($classmateMarks) {
                    $class_teacher = $classmateMarks->class_id;
                    $teacher = AssignClassTeacher::where('class_id', $class_teacher)->first();
                    if ($teacher) {
                        $teacher_name = $teacher->teacher_fullname;
                    } else {
                        $teacher_name = 'No teacher assigned';
                    }
                } else {
                    $teacher_name = 'No marks available';
                }
                if ($classmateMarks) {
                    $marks = json_decode($classmateMarks->marks, true);
                    $totalMarks = array_sum(array_column($marks, 'score'));
                    $subjectCount = count($marks);
                    $classAverages[$classmate->id] = $subjectCount ? $totalMarks / $subjectCount : 0;
                } else {
                    $classAverages[$classmate->id] = 0;
                }
            }
            $head_teacher = AssignHeadClassTeacher::where('class_id', $class_teacher)->first();
            if ($head_teacher) {
                $headteacher_name = $head_teacher->headteacher_fullname;
            } else {
                $headteacher_name = 'No head teacher assigned';
            }
            arsort($classAverages);
            $position = array_search($student->id, array_keys($classAverages)) + 1;
            arsort($classAverages);
            $position = array_search($student->id, array_keys($classAverages)) + 1;
            $highestAverage = max($classAverages);
            $lowestAverage = min($classAverages);
            $subjectScores = [];
            if ($marks) {
                foreach ($marks as $subjectId => $markDetails) {
                    if (isset($markDetails['score'])) {
                        $subjectScores[$subjectId] = $markDetails['score'];
                    } else {
                        $subjectScores[$subjectId] = 0;
                    }
                }
            }
            $totalScores = array_sum($subjectScores);
            $averageScore = $totalScores ? $totalScores / count($subjectScores) : 0;
            arsort($subjectScores);
            $subjectPosition = array_search($student->id, array_keys($subjectScores)) + 1;
            $marks = $studentMark ? json_decode($studentMark->marks, true) : null;
            $behaviorAttributes = $studentMark ? $studentMark->only(['class_participation', 'school_attendance', 'concentration', 'attitude_to_property', 'assignment', 'cleanliness', 'punctuality', 'general_conduct']) : [];
            $classRemark = $studentMark->class_remark ?? 'No remark provided.';
            $headRemark = $studentMark->head_remark ?? 'No remark provided.';
            $outstandingFees = $studentMark ? $studentMark->outstanding_fees : 'Not available';
            $nextTermFees = $studentMark ? $studentMark->next_term_fees : 'Not available';
            $subjectNames = [];
            if ($marks) {
                foreach ($marks as $subjectId => $markDetails) {
                    $subject = Subject::find($subjectId);
                    $subjectNames[$subjectId] = $subject ? $subject->subject_name : 'Unknown Subject';
                }
            }

            return view(
                'teacher.student.singleresult',
                compact(
                    'marks',
                    'school_information',
                    'subjectNames',
                    'student',
                    'totalStudentsInClass',
                    'position',
                    'highestAverage',
                    'lowestAverage',
                    'behaviorAttributes',
                    'classRemark',
                    'headRemark',
                    'resumptionDate',
                    'session',
                    'className',
                    'classArm',
                    'classSize',
                    'averageScore',
                    'subjectPosition',
                    'term',
                    'daysSchoolOpened',
                    'attendance',
                    'teacher_name',
                    'headteacher_name',
                    'outstandingFees',
                    'nextTermFees'
                )
            );
        } else {
            return response()->json(['message' => 'Student not found'], 404);
        }
    }
}
