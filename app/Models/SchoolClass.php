<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class SchoolClass extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        "capacity",
        "class_teacher",
    ];

    public function subjects():BelongsToMany {
        return $this->belongsToMany(Subject::class, "schoolclass_subject");
    }
}
