<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\Course\CourseResource;
use App\Models\Course;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    public function getAll(){
        $course = Course::with('module')->get();
        return CourseResource::collection($course);
    }
    public function show($id){
        $course = Course::findOrFail($id);
        return new CourseResource($course);
    }
}
