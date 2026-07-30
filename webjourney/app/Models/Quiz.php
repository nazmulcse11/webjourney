<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quiz extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'option_a',
        'option_b',
        'option_c',
        'option_d',
        'correct_answer',
        'quiz_type_id',
        'type',
        'status',
    ];
}
