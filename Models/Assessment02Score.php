<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Assessment02Score extends Model
{
    //
    use HasFactory;
    protected $table = 'assessment_02_score';
    protected $fillable = [
        'personal_num',
        'main_question_num',
        'other_question_num',
        'main_score',
        'other_score',
        'total_score',
        'points',
        'user_num',
        'round'
    ];

    public function MainQuestion()
    {
        return $this->belongsTo(MainQuestion::class, 'main_question_num');
    }
    public function OtherQuestion()
    {
        return $this->belongsTo(OtherQuestion::class, 'other_question_num');
    }
    public function personal()
    {
        return $this->belongsTo(User::class, 'personal_num');
    }

    // ความสัมพันธ์เพื่อดึงชื่อผู้ใช้อีกคนจาก user_num
    public function user()
    {
        return $this->belongsTo(User::class, 'user_num');
    }
}
