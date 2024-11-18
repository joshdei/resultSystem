<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Studentmarks extends Model
{
    protected $fillable = [
        'teacher_id',
        'school_session',
        'student_id',
        'class_id',
        'term',
        'attendance',
        'marks',
        'class_participation',
        'school_attendance',
        'concentration',
        'attitude_to_property',
        'assignment',
        'cleanliness',
        'punctuality',
        'general_conduct',
        'class_remark',
        'head_remark',
        'outstanding_fees',
        'next_term_fees',
    ];
    // Cast the 'marks' field to JSON
    protected $casts = [
        'marks' => 'array',
    ];
}
