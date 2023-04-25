<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    protected $table = 'answers';
    protected $guarded = false;

    public function question(){

        return $this->belongsTo(Question::class,'questions_id','id');
    }
}
