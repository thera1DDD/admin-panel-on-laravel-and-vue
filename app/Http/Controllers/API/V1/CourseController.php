<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\Course\CourseResource;
use App\Models\Course;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    public function getAll(){
        $course = Course::with('demovideo')->get();
        return CourseResource::collection($course);
    }
    public function show($id){
        $course = Course::findOrFail($id);
        return new CourseResource($course);
    }

    public function fullCourse($id){
        $course = Course::with('module.test', 'module.video', 'module.task')->find($id);
        if ($course) {
            return new CourseResource($course);
        } else {
            return response()->json(['error' => 'Курс не найден'], 404);
        }
    }
}
