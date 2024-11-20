<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class School extends Model
{
    protected $fillable = [
        'school_name',
        'school_motto',
        'school_address',
        'school_phone',
        'school_email',
        'school_logo',
        'owner_id',
    ]; 
    public function owner()
    {
        return $this->belongsTo(User::class, 'owner_id');
    }
}
