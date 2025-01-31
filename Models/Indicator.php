<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Indicator extends Model
{
    //
    use HasFactory;
    protected $table = 'indicator';
    protected $fillable = [
        'indicator_name',
        'main_question_num',
        'other_question_num',
        'indicator_status',
    ];

    public function mainQuestion() {
        return $this->belongsTo(MainQuestion::class,'main_question_num');
    }
    public function otherQuestion() {
        return $this->belongsTo(OtherQuestion::class,'other_question_num');
    }
}
