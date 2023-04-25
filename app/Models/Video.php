<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    protected $table = 'videos';
    protected $guarded = false;

    public function module(){

        return $this->belongsTo(Module::class,'modules_id','id');
    }
}
