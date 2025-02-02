<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SummarizePart01 extends Model
{
    //
    use HasFactory;
    protected $table = 'summarize_part_01';
    protected $fillable = [
        'personal_num',
        'evaluation_component_num',
        'points',
        'points_multiply',
        'weight_score',
        'total_points',
        'criterion_num',
        'evaluator_num',
        'round',
    ];

    public function personal() {
        return $this->belongsTo(User::class,'personal_num');
    }

    public function evaluator() {
        return $this->belongsTo(User::class,'evaluator_num');
    }
    public function criterion() {
        return $this->belongsTo(Criterion::class,'criterion_num');
    }
    public function evaluation_components() {
        return EvaluationComponent::whereIn('id', json_decode($this->evaluation_component_num, true))->get();
    }
}
