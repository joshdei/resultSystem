<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AssignSession extends Model
{
    protected $fillable = [
    
        'session',
        'owner_id',
    ];
    
}
