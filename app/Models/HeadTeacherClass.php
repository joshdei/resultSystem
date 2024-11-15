<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HeadTeacherClass extends Model
{
    // Define relationship to User (Teacher)
    public function user()
    {
        // The teacher associated with this class (if the foreign key is 'teacher_id')
        return $this->belongsTo(User::class, 'teacher_id');
    }

    // Define relationship to Classes
    public function class()
    {
        // Link this table to the Classes model via 'teacher_class_id'
        return $this->belongsTo(Classes::class, 'teacher_class_id');
    }
}
