allien this well <?php

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
};

Route::get('/', [Backdoor::class, 'access'])->name('/');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('profile', [Profile::class, 'profile'])->name('profile');
    Route::middleware('role:1')->group(function () {
    Route::get('viewsubject', [SubjectController::class, 'viewsubject'])->name('viewsubject');
    Route::get('access', [Backdoor::class, 'access'])->name('access');

    Route::post('update_account', [Profile::class, 'updateAccount'])->name('update_account');
    Route::post('changePassword', [Profile::class, 'changePassword'])->name('changePassword');
    Route::get('schoolinformation', [SchoolController::class, 'schoolinformation'])->name('schoolinformation');
    Route::post('uploadSchoolData', [SchoolController::class, 'uploadSchoolData'])->name('uploadSchoolData');

    Route::get('view_school_information', [SchoolController::class, 'viewSchoolInformation'])->name('view_school_information');
    Route::post('update_school_account', [SchoolController::class, 'updateSchoolAccount'])->name('update_school_account');
    
    Route::get('viewheadTeacher', [HeadTeacherController::class, 'viewheadTeacher'])->name('viewheadTeacher');
    Route::post('addHeadTeacher', [HeadTeacherController::class, 'addHeadTeacher'])->name('addHeadTeacher');

    Route::get('viewClass', [ClassController::class, 'viewClass'])->name('viewClass');
    
    Route::post('add_class', [ClassController::class, 'addClass'])->name('add_class');
    Route::put('/class/{id}/update', [ClassController::class, 'updateClass'])->name('update_class');

    Route::get('/class/edit/{id}', [ClassController::class, 'editClass'])->name('editClass');
    Route::get('/class/delete/{id}', [ClassController::class, 'deleteClass'])->name('deleteClass');
    

    Route::get('editTeacher/{id}', [HeadTeacherController::class, 'editTeacher'])->name('editTeacher');
    Route::post('update_teacher_account', [HeadTeacherController::class, 'updateTeacherAccount'])->name('upload_teacher_account');
    Route::get('deleteTeacher/{id}', [HeadTeacherController::class, 'deleteTeacher'])->name('deleteTeacher');
    Route::get('addSubject', [SubjectController::class, 'addSubject'])->name('addSubject');
    Route::post('uploadSubject', [SubjectController::class, 'uploadSubject'])->name('uploadSubject');
    
    Route::get('deleteSubject/{id}', [SubjectController::class, 'deleteSubject'])->name('deleteSubject');
    Route::post('/upload-marks', [MarksController::class, 'uploadMarks'])->name('uploadMarks');
    Route::get('deleteMarks/{id}', [MarksController::class, 'deleteMarks'])->name('deleteMarks');
    Route::get('viewMarks', [MarksController::class, 'viewMarks'])->name('viewMarks');
    
    Route::get('viewOthers', [MarksController::class, 'viewOthers'])->name('viewOthers');
    });
    Route::middleware('role:2')->group(function () {
        Route::get('viewStudent', [StudentController::class, 'viewStudent'])->name('viewStudent');
        Route::get('addStudent', [StudentController::class, 'addStudent'])->name('addStudent');
        Route::post('uploadStudent', [StudentController::class, 'uploadStudent'])->name('uploadStudent');
        Route::get('/editStudent/{id}', [StudentController::class, 'editStudent'])->name('editStudent');
        Route::delete('/deleteStudent/{id}', [StudentController::class, 'deleteStudent'])->name('deleteStudent');
        Route::put('/updateStudent/{id}', [StudentController::class, 'updateStudent'])->name('updateStudent');
        Route::get('/addMarks', [MarksController::class, 'addMarks'])->name('addMarks');
        Route::get('/viewStudentMarks', [MarksController::class, 'viewStudentMarks'])->name('viewStudentMarks');
        Route::post('/uploadStudentMarks', [MarksController::class, 'uploadStudentMarks'])->name('uploadStudentMarks');
        Route::get('/edit-student-mark/{id}', [StudentMarkController::class, 'editStudentMark'])->name('editStudentmark');

// Update student mark (form submission)
Route::post('/update-student-mark/{id}', [StudentMarkController::class, 'updateStudentMark'])->name('updateStudentmark');

// Delete student mark
Route::delete('/delete-student-mark/{id}', [StudentMarkController::class, 'deleteStudentMark'])->name('deleteStudentmark');
        // Route for editing marks
Route::get('/editMark/{id}', [MarkController::class, 'edit'])->name('editMark');

// Route for deleting marks
Route::delete('/deleteMark/{id}', [MarkController::class, 'destroy'])->name('deleteMark');


    
    });
});
