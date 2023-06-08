<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stat extends Model
{
    protected $table = 'stats';
    protected $guarded = false;

    public function course(){
        return $this->belongsTo(Course::class,'passed_courses_id','id');
    }
    public function video(){
        return $this->belongsTo(Video::class,'passed_videos_id','id');
    }
    public function module(){
        return $this->belongsTo(Module::class,'passed_modules_id','id');
    }
    public function user(){
        return $this->belongsTo(User::class,'users_id','id');
    }

    public function task(){
        return $this->belongsTo(Task::class,'passed_tasks_id','id');
    }
    public function test(){
        return $this->belongsTo(Test::class,'passed_tests_id','id');
    }
}
