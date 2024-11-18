<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SchoolOpening extends Model
{
    
    protected $fillable = [
        'number',
        'owner_id',
    ];
}
