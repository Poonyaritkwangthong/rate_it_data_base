<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PersonalScore extends Model
{
    //
    use HasFactory;
    protected $table = 'personal_score';
    protected $fillable = [
        'personal_num',
        'question_num',
        'score',
        'total_score',
        'user_num',
        'round'
    ];


public function user()
{
    return $this->belongsTo(User::class,'user_num');
}

}
