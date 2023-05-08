<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Demovideo extends Model
{
    protected $table = 'demovideos';
    protected $guarded = false;

    public function course(){

        return $this->belongsTo(Course::class,'courses_id','id');
    }
}
