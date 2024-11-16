<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StudentMark extends Model
{
    protected $fillable = [
        'teacher_id',
        'student_first_test_marks',
        'student_second_test_marks',
        'student_exam_marks',
        'student_id',
    ];
   
    public function student()
    {
        return $this->belongsTo(Student::class, 'student_id', 'id');
    }
}
