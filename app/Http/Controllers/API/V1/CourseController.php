<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\API\MainApiController;
use App\Http\Controllers\Controller;
use App\Http\Resources\Course\CourseResource;
use App\Http\Resources\Course\ModuleResource;
use App\Http\Resources\Course\SingleCourseResource;
use App\Models\Course;
use App\Models\Module;
use App\Models\Stat;
use Illuminate\Http\Request;
use PhpParser\Node\Expr\AssignOp\Mod;

class CourseController extends MainApiController
{
    public function getAll(){
        $course = Course::with('demovideo')->get();
        if(isset($course)){
            return CourseResource::collection($course);
        }
        else{
            return $this->error('course not found',404);
        }

    }
    public function show($id){
        $course = Course::with('demovideo')->find($id);
        if(isset($course)) {
            return new SingleCourseResource($course);
        }
        else{
            return $this->error('course not found',404);
        }
    }

    public function courseWithProgress($courseId,$userId)
    {
        $course = Course::find($courseId);
        //получение количества просмотренных видео курса
        $passed_videos = Stat::where('courses_id',$courseId)->where('users_id',$userId)->whereNotNull('passed_videos_id')->count();
        $passed_tasks = Stat::where('courses_id',$courseId)->where('users_id',$userId)->whereNotNull('passed_tasks_id')->count();
        //
        if (isset($course,$passed_tasks,$passed_videos)){
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
            $courseResource->passedVideos = $passed_videos;
            $courseResource->passedTasks = $passed_tasks;
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
