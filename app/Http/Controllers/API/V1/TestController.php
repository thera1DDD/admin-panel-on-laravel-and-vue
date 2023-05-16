<?php

namespace App\Http\Controllers\API\V1;


use App\Http\Controllers\Controller;
use App\Http\Resources\Test\TestResource;
use App\Http\Resources\Teacher\TeacherResource;
use App\Models\Course;
use App\Models\Teacher;
use App\Models\Test;
use Illuminate\Http\Request;

class TestController extends Controller
{
    public function getWithQuestions($id){
        $test = Test::findOrFail($id)->with('question')->first();
        return new TestResource($test);
    }
}
