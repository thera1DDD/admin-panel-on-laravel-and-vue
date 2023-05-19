<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\API\MainApiController;
use App\Http\Controllers\Controller;
use App\Http\Resources\Course\CourseResource;
use App\Http\Resources\Course\ModuleResource;
use App\Models\Course;
use App\Models\Module;
use Illuminate\Http\Request;
use PhpParser\Node\Expr\AssignOp\Mod;

class CourseController extends MainApiController
{
    public function getAll(){
        $course = Course::with('demovideo')->get();
        return CourseResource::collection($course);
    }
    public function show($id){
        $course = Course::findOrFail($id);
        return new CourseResource($course);
    }

    public function CourseWithStat($id)
    {
        $course = Course::find($id);
        if (isset($course)) {
        $totalVideos = $course->module->flatMap(function ($module) {
            return $module->video;
        })->count();
        $totalTests = $course->module->flatMap(function ($module) {
            return $module->test;
        })->count();
        $totalTasks = $course->module->flatMap(function ($module) {
            return $module->task;
        })->count();
        $totalExam = $course->test()->count();
            $courseResource = new CourseResource($course->loadCount('module'));
            $courseResource->totalVideos = $totalVideos;
            $courseResource->totalTests = $totalTests;
            $courseResource->totalTasks = $totalTasks;
            $courseResource->totalExam = $totalExam;

            return $courseResource;
        } else {
            return $this->error('Course not found', 404);
        }
    }

    public function moduleShow($id){
        $module = Module::with('video','test','task')->find($id);
        return new ModuleResource($module);
    }
}
