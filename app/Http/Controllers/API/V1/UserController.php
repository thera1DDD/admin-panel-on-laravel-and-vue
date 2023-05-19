<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\API\MainApiController;
use App\Http\Controllers\Controller;
use App\Http\Resources\Cabinet\UserResource;
use App\Http\Resources\Course\CourseResource;
use App\Models\Course;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends MainApiController
{
    public function getAll(){
        $course = Course::with('demovideo')->get();
        return CourseResource::collection($course);
    }
    public function show($id){
        $user = User::findOrFail($id);
        if (!$user) {
            return response()->json(['message' => 'Cabinet not found'], 404);
        }
        return new UserResource($user);
    }

//    public function fullCourse($id){
//        $course = Course::with('module.test', 'module.video', 'module.task')->find($id);
//        if ($course) {
//            return new CourseResource($course);
//        } else {
//            return response()->json(['error' => 'Курс не найден'], 404);
//        }
//    }
}
