<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WorkAffiliation extends Model
{
    //
    use HasFactory;
    protected $table = 'work_affiliations';
    protected $fillable = [
        'work_affiliations_name',
    ];
}
