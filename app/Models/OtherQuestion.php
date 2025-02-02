<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OtherQuestion extends Model
{
    //
    use HasFactory;
    protected $table = 'other_question';
    protected $fillable = [
        'other_question_name',
        'other_question_status',
        'other_question_multiply',
    ];
}
