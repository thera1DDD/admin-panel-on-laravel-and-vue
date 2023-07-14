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
    public function course(){
        return $this->belongsTo(Course::class,'courses_id','id');
    }


    public static function addOrUpdateResult($data)
    {
        $existingResult = self::where('tests_id', $data['tests_id'])
            ->where('users_id',$data['users_id'])
            ->first();
        if ($existingResult) {
            $existingResult->update($data);
        } else {
            self::create($data);
        }
    }
}
