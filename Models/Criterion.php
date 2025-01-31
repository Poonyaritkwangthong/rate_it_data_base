<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Criterion extends Model
{
    //
    use HasFactory;
    protected $table = 'criterion';
    protected $fillable = [
        'criterion_name',
        'criterion_status',
    ];
}
