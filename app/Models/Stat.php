<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stat extends Model
{
    protected $table = 'stats';
    protected $guarded = false;

    public function passed_courses(){
        return $this->belongsTo(Course::class,'passed_courses_id','id');
    }
    public function passed_videos(){
        return $this->belongsTo(Video::class,'passed_videos_id','id');
    }
    public function passed_modules(){
        return $this->belongsTo(Module::class,'passed_modules_id','id');
    }
    public function user(){
        return $this->belongsTo(User::class,'users_id','id');
    }
    public function course(){
        return $this->belongsTo(Course::class,'courses_id','id');
    }

}
