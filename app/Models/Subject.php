<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    protected $fillable = [
        'subject_name',
        'subject_class_id',
        'owner_id',
    ]; 
    public function class()
{
    return $this->belongsTo(Classes::class, 'subject_class_id');
}

}
