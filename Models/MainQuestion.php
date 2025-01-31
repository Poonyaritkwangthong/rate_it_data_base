<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MainQuestion extends Model
{
    //
    use HasFactory;
    protected $table = 'main_question';
    protected $fillable = [
        'main_question_name',
        'main_question_status',
        'main_question_multiply',
    ];
}
