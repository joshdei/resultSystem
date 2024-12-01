<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StoreStudentScores extends Model
{
    protected $fillable = [
        'teacher_id',
        'student_id',
        'marks',
        'class_id',
    ];
}
