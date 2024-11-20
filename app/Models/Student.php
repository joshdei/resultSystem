<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $fillable = [
        'teacher_id',
        'firstname',
        'lastname',
        'gender',
        'student_identication',
        'class_id',
        'class_name',
        'class_arm',
        'profile_image',
    ];
    public function marks()
    {
        return $this->hasMany(StudentMark::class, 'student_id', 'id');
    }

    public function class()
    {
        return $this->belongsTo(Classes::class, 'class_id');
    }
}
