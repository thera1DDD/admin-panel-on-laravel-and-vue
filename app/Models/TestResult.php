<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TestResult extends Model
{
    protected $table = 'tests_results';
    protected $guarded = false;

    public function user(){
        return $this->belongsTo(User::class,'users_id','id');
    }
    public function test(){
        return $this->belongsTo(Test::class,'tests_id','id');
    }
}
