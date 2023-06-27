<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RegisterCourse extends Model
{
    use HasFactory;
    protected $table = 'rigister_course';

    protected $fillable = [
        'id',
        'user_id',
        'course_id',
    ];
}
