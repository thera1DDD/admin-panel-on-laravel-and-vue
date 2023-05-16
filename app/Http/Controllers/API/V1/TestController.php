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
    public function show($id){
        $test = Test::with('question.answer')->find($id);
        if (!$test) {
            return response()->json(['message' => 'Test not found'], 404);
        }
        return new TestResource($test);
    }

    public function getAll(){
        $test = Test::with('question.answer')->get();
        if (!$test) {
            return response()->json(['message' => 'Test not found'], 404);
        }
        return TestResource::collection($test);
    }
}
