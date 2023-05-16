<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $table = 'questions';
    protected $guarded = false;

    public function test(){
        return $this->belongsTo(Test::class,'tests_id','id');
    }

    public function answer(){
        return $this->hasMany(Answer::class,'questions_id');
    }
}
