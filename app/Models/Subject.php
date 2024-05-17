<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'assigned_teacher',
    ];

    public function school_classes() {
        return $this->belongsToMany(SchoolClass::class);
    }
}
