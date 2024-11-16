<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    Backdoor,
    Profile,
    SchoolController,
    HeadTeacherController,
    ClassController,
    SubjectController,
    MarksController,
    StudentController,
    StudentMarkController,
    AssignCOntroller,
};

// Public Routes
Route::get('/', [Backdoor::class, 'access'])->name('/');

// Authenticated Routes
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {

    // Profile Routes
    Route::get('profile', [Profile::class, 'profile'])->name('profile');
    Route::post('update_account', [Profile::class, 'updateAccount'])->name('update_account');
    Route::post('changePassword', [Profile::class, 'changePassword'])->name('changePassword');

    // Admin Routes (Role 1)
    Route::middleware('role:1')->group(function () {

        // Backdoor and School Information
        Route::get('access', [Backdoor::class, 'access'])->name('access');
        Route::get('schoolinformation', [SchoolController::class, 'schoolinformation'])->name('schoolinformation');
        Route::post('uploadSchoolData', [SchoolController::class, 'uploadSchoolData'])->name('uploadSchoolData');
        Route::get('view_school_information', [SchoolController::class, 'viewSchoolInformation'])->name('view_school_information');
        Route::post('update_school_account', [SchoolController::class, 'updateSchoolAccount'])->name('update_school_account');

        // Head Teacher Routes
        Route::get('viewheadTeacher', [HeadTeacherController::class, 'viewheadTeacher'])->name('viewheadTeacher');
        Route::post('addHeadTeacher', [HeadTeacherController::class, 'addHeadTeacher'])->name('addHeadTeacher');
        Route::get('editTeacher/{id}', [HeadTeacherController::class, 'editTeacher'])->name('editTeacher');
        Route::post('update_teacher_account', [HeadTeacherController::class, 'updateTeacherAccount'])->name('upload_teacher_account');
        Route::get('deleteTeacher/{id}', [HeadTeacherController::class, 'deleteTeacher'])->name('deleteTeacher');

        // Class Routes
        Route::get('viewClass', [ClassController::class, 'viewClass'])->name('viewClass');
        Route::post('add_class', [ClassController::class, 'addClass'])->name('add_class');
        Route::put('/class/{id}/update', [ClassController::class, 'updateClass'])->name('update_class');
        Route::get('/class/edit/{id}', [ClassController::class, 'editClass'])->name('editClass');
        Route::get('/class/delete/{id}', [ClassController::class, 'deleteClass'])->name('deleteClass');

        // Subject Routes
        Route::get('viewsubject', [SubjectController::class, 'viewsubject'])->name('viewsubject');
        Route::get('addSubject', [SubjectController::class, 'addSubject'])->name('addSubject');
        Route::post('uploadSubject', [SubjectController::class, 'uploadSubject'])->name('uploadSubject');
        Route::get('deleteSubject/{id}', [SubjectController::class, 'deleteSubject'])->name('deleteSubject');

        // Marks Routes
        Route::post('/upload-marks', [MarksController::class, 'uploadMarks'])->name('uploadMarks');
        Route::get('viewMarks', [MarksController::class, 'viewMarks'])->name('viewMarks');
        Route::get('viewOthers', [MarksController::class, 'viewOthers'])->name('viewOthers');
        Route::get('deleteMarks/{id}', [MarksController::class, 'deleteMarks'])->name('deleteMarks');

        //Assign
        
        Route::delete('/teacher/delete/{id}', [AssignCOntroller::class, 'destroy'])->name('delete.teacher');
        
        Route::delete('/teacher/head/delete/{id}', [AssignCOntroller::class, 'destroyheadteacher'])->name('delete.headteacher');
         
        Route::delete('/teacher/session/delete/{id}', [AssignCOntroller::class, 'deleteSession'])->name('delete.session');
        Route::delete('/teacher/resumption/delete/{id}', [AssignCOntroller::class, 'deleteResumption'])->name('delete.resumption');
        
        Route::get('assign_teacher', [AssignCOntroller::class, 'assign_teacher'])->name('assign_teacher');
        Route::get('assign_head_teacher', [AssignCOntroller::class, 'assign_head_teacher'])->name('assign_head_teacher');

        Route::post('addclassTeacher', [AssignCOntroller::class, 'addclassTeacher'])->name('addclassTeacher');
        Route::post('addclassHeadTeacher', [AssignCOntroller::class, 'addHeadclassTeacher'])->name('addclassHeadTeacher');
        

        Route::post('uploadresumption', [AssignCOntroller::class, 'uploadresumption'])->name('uploadresumption');
        Route::post('uploadsession', [AssignCOntroller::class, 'uploadsession'])->name('uploadsession');
        Route::get('assign_session', [AssignCOntroller::class, 'assign_session'])->name('assign_session');
        Route::get('assign_resumption_date', [AssignCOntroller::class, 'assign_resumption_date'])->name('assign_resumption_date');
    });

    // Teacher Routes (Role 2)
    Route::middleware('role:2')->group(function () {

        // Student Routes
        Route::get('viewStudent', [StudentController::class, 'viewStudent'])->name('viewStudent');
        Route::get('addStudent', [StudentController::class, 'addStudent'])->name('addStudent');
        Route::post('uploadStudent', [StudentController::class, 'uploadStudent'])->name('uploadStudent');
        Route::get('/editStudent/{id}', [StudentController::class, 'editStudent'])->name('editStudent');
        Route::delete('/deleteStudent/{id}', [StudentController::class, 'deleteStudent'])->name('deleteStudent');
        Route::put('/updateStudent/{id}', [StudentController::class, 'updateStudent'])->name('updateStudent');

        // Marks Management
        Route::get('/addMarks', [MarksController::class, 'addMarks'])->name('addMarks');
        Route::get('/viewStudentMarks', [MarksController::class, 'viewStudentMarks'])->name('viewStudentMarks');
        Route::post('/uploadStudentMarks', [MarksController::class, 'uploadStudentMarks'])->name('uploadStudentMarks');

        // Student Marks Specific Actions
        Route::get('/edit-student-mark/{id}', [StudentMarkController::class, 'editStudentMark'])->name('editStudentmark');
        Route::post('/update-student-mark/{id}', [StudentMarkController::class, 'updateStudentMark'])->name('updateStudentmark');
        Route::delete('/delete-student-mark/{id}', [StudentMarkController::class, 'deleteStudentMark'])->name('deleteStudentmark');

        // Generic Marks Actions
        Route::get('/editMark/{id}', [MarksController::class, 'edit'])->name('editMark');
        Route::delete('/deleteMark/{id}', [MarksController::class, 'destroy'])->name('deleteMark');
    });
});
