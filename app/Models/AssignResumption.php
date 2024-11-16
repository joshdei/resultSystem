<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AssignResumption extends Model
{
    protected $fillable = [
        'date',
        'owner_id',
    ];
}
