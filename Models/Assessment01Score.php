<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Assessment01Score extends Model
{
    //
    use HasFactory;
    protected $table = 'assessment_01_score';
    protected $fillable = [
        'personal_num',
        'other_question_num',
        'other_score',
        'total_score',
        'points',
        'user_num',
        'round'
    ];

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
