<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TaskResult extends Model
{
    protected $table = 'tasks_results';
    protected $guarded = false;

    public function user(){
        return $this->belongsTo(User::class,'users_id','id');
    }
    public function task(){
        return $this->belongsTo(Task::class,'tasks_id','id');
    }
}
