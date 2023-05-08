<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    protected $table = 'courses';
    protected $guarded = false;

    public function language(){

        return $this->belongsTo(Language::class,'languages_id','id');
    }


}
