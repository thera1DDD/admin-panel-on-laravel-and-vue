<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Test extends Model
{
    protected $table = 'tests';
    protected $guarded = false;

    public function testable(){
        return $this->morphTo();
    }

    public function question(){
        return $this->hasMany(Question::class,'tests_id');
    }


}
