<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Classes extends Model
{
    protected $fillable = [
        'class_name',
        'class_arm',
        'class_size',
        'owner_id',
    ];
    
    protected $casts = [
        'class_arm' => 'array',  // Cast to array
    ];

    // Optionally, define a relationship back to HeadTeacherClass
    public function headTeacherClass()
    {
        return $this->hasOne(HeadTeacherClass::class, 'teacher_class_id');
    }
}
