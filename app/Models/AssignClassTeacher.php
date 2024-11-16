<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AssignClassTeacher extends Model
{
    protected $fillable = [
        'owner_id',
        'class_id',
        'teacher_fullname',
    ];
    
}
