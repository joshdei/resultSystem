<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $fillable = [
        'teacher_id',
        'firstname',
        'lastname',
        'class_id',
        'class_name',
        'class_arm',
        'profile_image',
    ];
}
