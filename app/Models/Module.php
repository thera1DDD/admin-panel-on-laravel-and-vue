<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Module extends Model
{
    protected $table = 'modules';
    protected $guarded = false;

    public function course(){
        return $this->belongsTo(Course::class,'courses_id','id');
    }

    public function test(){
        return $this->morphMany(Test::class,'testable');
    }
}
