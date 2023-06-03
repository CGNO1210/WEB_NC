<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Courses extends Model
{
    use HasFactory;
    protected $table = 'courses';

    protected $fillable = [
        'id',
        'cour_name',
        'cour_img',
        'cour_description',
        'cour_price',
        'slug'
    ];

}
