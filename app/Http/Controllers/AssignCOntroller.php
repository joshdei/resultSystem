<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\HeadTeacher;
use App\Models\AssignClassTeacher;
use App\Models\AssignHeadClassTeacher;
use App\Models\Classes;
use App\Models\AssignSession;
use App\Models\AssignResumption;

use Illuminate\Support\Facades\Hash;
use App\Models\HeadTeacherClass;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
class AssignCOntroller extends Controller
{
    public function assign_teacher()
    {
        $userId = Auth::user()->id;

        // Fetch teacher assignments for the current owner
        $teacherAssignments = AssignClassTeacher::where('owner_id', $userId)->get();

        // Create an array to store teacher-class details
        $teacherClasses = [];
        foreach ($teacherAssignments as $assignment) {
            $class = Classes::find($assignment->class_id);
            if ($class) {
                $teacherClasses[] = [
                    'id' => $assignment->id, // Include assignment ID
                    'teacher_name' => $assignment->teacher_fullname,
                    'class_name' => $class->class_name,
                ];
            }
        }

        // Fetch available classes
        $classes = Classes::where('owner_id', $userId)->get();

        return view('admin.assign.assign_teacher', compact('teacherClasses', 'classes'));
    }

    public function addclassTeacher(Request $request)
    {
        $upload = new AssignClassTeacher();
        $upload->owner_id = Auth::user()->id;
        $upload->class_id = $request->class_id;
        $upload->teacher_fullname = $request->teacher_fullname;
        $upload->save();
        return redirect()->route('assign_teacher');
    }

    public function destroy($id)
    {
        $assignment = AssignClassTeacher::find($id);

        if (!$assignment) {
            return redirect()
                ->back()
                ->with('error', 'Teacher assignment not found.');
        }

        $assignment->delete();
        return redirect()
            ->back()
            ->with('success', 'Teacher assignment deleted successfully.');
    }

    public function assign_head_teacher()
    {
        $userId = Auth::user()->id;

        // Fetch teacher assignments for the current owner
        $teacherAssignments = AssignHeadClassTeacher::where('owner_id', $userId)->get();

        // Create an array to store teacher-class details
        $teacherheadClasses = [];
        foreach ($teacherAssignments as $assignment) {
            $class = Classes::find($assignment->class_id);
            if ($class) {
                $teacherheadClasses[] = [
                    'id' => $assignment->id, // Include assignment ID
                    'headteacher_fullname' => $assignment->headteacher_fullname,
                    'class_name' => $class->class_name,
                ];
            }
        }

        // Fetch available classes
        $classes = Classes::where('owner_id', $userId)->get();
        return view('admin.assign.assign_head_teacher', compact('teacherheadClasses', 'classes'));
    }

    public function deleteSession($id)
    {
        $assignment = AssignSession::find($id);

        if (!$assignment) {
            return redirect()
                ->back()
                ->with('error', 'session assignment not found.');
        }

        $assignment->delete();
        return redirect()
            ->back()
            ->with('success', 'session deleted successfully.');
    }

    public function deleteResumption($id)
    {
        $assignment = AssignResumption::find($id);

        if (!$assignment) {
            return redirect()
                ->back()
                ->with('error', 'Date assignment not found.');
        }

        $assignment->delete();
        return redirect()
            ->back()
            ->with('success', 'Date assignment deleted successfully.');
    }

    public function destroyheadteacher($id)
    {
        $assignment = AssignHeadClassTeacher::find($id);

        if (!$assignment) {
            return redirect()
                ->back()
                ->with('error', 'Teacher assignment not found.');
        }

        $assignment->delete();
        return redirect()
            ->back()
            ->with('success', 'Teacher assignment deleted successfully.');
    }

    public function addHeadclassTeacher(Request $request)
    {
        $upload = new AssignHeadClassTeacher();
        $upload->owner_id = Auth::user()->id;
        $upload->class_id = $request->class_id;
        $upload->headteacher_fullname = $request->headteacher_fullname;
        $upload->save();
        return redirect()->route('assign_head_teacher');
    }

    public function assign_session()
    {
        $userId = Auth::user()->id;
        $session = AssignSession::where('owner_id', $userId)->get();
        return view('admin.assign.session', compact('session'));
    }

    public function uploadsession(Request $request)
    {
        $upload = new AssignSession();
        $upload->owner_id = Auth::user()->id;
        $upload->session = $request->team_session;
        $upload->save();
        return redirect()->route('assign_session');
    }

    public function assign_resumption_date()
    {
        $userId = Auth::user()->id;
        $assig_resumption = AssignResumption::where('owner_id', $userId)->get();
        return view('admin.assign.assig_resumption', compact('assig_resumption'));
    }

    public function uploadresumption(Request $request)
    {
        $upload = new AssignResumption();
        $upload->owner_id = Auth::user()->id;
        $upload->date = $request->date;
        $upload->save();
        return redirect()->route('assign_resumption_date');
    }
}
