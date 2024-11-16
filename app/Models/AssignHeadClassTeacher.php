<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AssignHeadClassTeacher extends Model
{
    protected $fillable = [
        'owner_id',
        'class_id',
        'headteacher_fullname',
    ];
}
