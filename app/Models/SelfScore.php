<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SelfScore extends Model
{
    //
    use HasFactory;
    protected $table = 'self_score';

    protected $fillable = [
        'personal_num',
        'main_question_num',
        'other_question_num',
        'main_score',
        'other_score',
        'total_score',
        'points',
        'round'
    ];
}
