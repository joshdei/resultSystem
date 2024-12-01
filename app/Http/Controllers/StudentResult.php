<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{User, Student, Mark, School, Subject, Studentmarks, Term, Classes, AssignSesssion, AssignResumption, AsssignClassTeacher, AssignHeadClassTeacher, HeadTeacherClass, AssignSession, AssignClassTeacher, SchoolOpening};

class StudentResult extends Controller
{
    public function singleStudentResult($id)
    {
        $check_student = Student::where('id',$id)->first();
        if ($check_student) {
            $student_info = Studentmarks::where('student_id',$check_student->id)->first();

            $student_Class_Id = $student_info->class_id;
            $subject_count = Subject::where('subject_class_id', $student_Class_Id)->count();
            $class = Classes::where('id',$student_Class_Id)->first();

            $owner_id = $class ? $class->owner_id : null;
            $school_information = $owner_id ? School::where('owner_id', $owner_id)->get() : collect();
            $resumptionDate = $owner_id ? AssignResumption::where('owner_id', $owner_id)->value('date') : 'Not assigned';
            $session = $owner_id ? AssignSession::where('owner_id', $owner_id)->value('session') : 'Not assigned';
            $className = $class ? $class->class_name : 'Unknown';
            $classSize = $class ? $class->class_size : 'Unknown';
            $classArm = $check_student->class_arm ?? ($check_student->class->class_arm ?? 'Unknown');
            $term = $owner_id ? Term::where('owner_id', $owner_id)->value('term') : 'Not assigned';
            $daysSchoolOpened = $owner_id ? SchoolOpening::where('owner_id', $owner_id)->value('number') : 'Not assigned';


            $studentMark = Studentmarks::where('student_id', $id)->first();
            $attendance = $studentMark ? $studentMark->attendance : 'Not recorded';
            $get_teacher_name = AssignClassTeacher::where('class_id', $student_Class_Id)->first();
            $teacher_name = $get_teacher_name->teacher_fullname;
            $head_teacher = AssignHeadClassTeacher::where('class_id', $student_Class_Id)->first();
            $headteacher_name = $head_teacher->headteacher_fullname;

            $marks = $studentMark ? json_decode($studentMark->marks, true) : null;
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
            $classRemark = $studentMark->class_remark ?? 'No remark provided.';
            $headRemark = $studentMark->head_remark ?? 'No remark provided.';
            return view(
                'teacher.student.singleresult',
                compact(
                    'marks',
                    'classRemark',
                    'headRemark',
                    'school_information',
                    'subjectNames',
                    'behaviorAttributes',
                    'classRemark',
                    'headRemark',
                    'resumptionDate',
                    'session',
                    'className',
                    'classArm',
                    'classSize',
                    'teacher_name',
                    'headteacher_name',
                    'term',
                    'daysSchoolOpened',
                    'attendance',
                    'outstandingFees',
                    'nextTermFees',
                    'check_student',
                )
            );
        } else {
            return response()->json(['message' => 'Student not found'], 404);
        }
    }
}
