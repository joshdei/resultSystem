<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Mark extends Model
{
    protected $fillable = [
        'first_test_marks',
        'second_test_marks',
        'exam_marks',
        'owner_id',
    ]; 
}
