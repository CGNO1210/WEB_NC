<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chapter extends Model
{
    use HasFactory;
    protected $table = 'chapter';

    protected $fillable = [
        'id',
        'cour_id',
        'chapter_name',
        'chapter_slug'
    ];
}
