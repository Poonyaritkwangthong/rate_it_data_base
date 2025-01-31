<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use PhpParser\Node\Expr\FuncCall;

class AboveComment extends Model
{
    use HasFactory;
    protected $table = 'above_comments';
    protected $fillable = [
        'personal_num',
        'above_comment_num',
        'above_comment_detail',
        'above_num',
        'above_signature',
        'round',
    ];

    public function personal() {
        return $this->belongsTo(User::class,'personal_num');
    }

    public function above() {
        return $this->belongsTo(User::class,'above_num');
    }

    public function comments() {
        return $this->belongsTo(Comments::class,'above_comment_num');
    }
}
