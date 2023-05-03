<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Translate extends Model
{
    protected $table = 'translates';
    protected $guarded = false;


    public function word(){

        return $this->belongsTo(Word::class,'words_id','id');
    }
}
