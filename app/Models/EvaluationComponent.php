<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EvaluationComponent extends Model
{
    //
    use HasFactory;
    protected $table = 'evaluation_component';
    protected $fillable = [
        'component_name',
        'component_status',
        'component_weight',
    ];
}
