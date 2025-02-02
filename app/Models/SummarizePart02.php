<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SummarizePart02 extends Model
{
    //
    use HasFactory;
    protected $table = 'summarize_part_02';
    protected $fillable = [
        'personal_num',
        'skill_to_dev',
        'dev_method',
        'dev_time',
        'evaluator_num',
        'round',
    ];

    public function personal() {
        return $this->belongsTo(User::class,'personal_num');
    }

    public function evaluator() {
        return $this->belongsTo(User::class,'evaluator_num');
    }
}
