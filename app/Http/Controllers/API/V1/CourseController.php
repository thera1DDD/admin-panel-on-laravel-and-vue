<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Models\Course;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    public function getAll(){
        $courses = Course::with('demovideo','module')->get();
        return response()->json($courses);
    }
}
