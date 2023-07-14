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
use App\Models\TestResult;
use Illuminate\Http\Request;
use PhpParser\Node\Expr\AssignOp\Mod;

class CourseController extends MainApiController
{
    public function getAll()
    {
        $course = Course::with('demovideo')->get();
        if (isset($course)) {
            return SingleCourseResource::collection($course);
        } else {
            return $this->error('course not found', 404);
        }

    }

    public function show($code)
    {
        $course = Course::with('demovideo')->where('code', $code)->first();
        if (isset($course)) {
            return new SingleCourseResource($course);
        } else {
            return $this->error('course not found', 404);
        }
    }

    public function courseWithProgress($courseId, $userId, $code)
    {
        //получние курса по code
        $course = Course::where('code', $code)->first();
        //получение количества просмотренных видео курса
        $passed_videos = Stat::where('courses_id', $courseId)->where('users_id', $userId)->whereNotNull('passed_videos_id')->count();
        $passed_tests = TestResult::where('courses_id', $courseId)->where('users_id', $userId)->where('is_passed',1)->count();
        //
        //подсчет имеющихся видео, тестов, заданий в курсе
        if (isset($course,  $passed_tests, $passed_videos)) {
            $totalVideos = $course->module->flatMap(function ($module) {
                return $module->video;
            })->count();
            $totalTests = $course->module->flatMap(function ($module) {
                return $module->test;
            })->count();
            $totalExam = $course->test()->count();
            $courseResource = new CourseResource($course->loadCount('module'));
            $courseResource->totalVideos = $totalVideos;
            $courseResource->totalTests = $totalTests;
            $courseResource->totalExam = $totalExam;
            $courseResource->passedVideos = $passed_videos;
            $courseResource->passedTests = $passed_tests;
            //
            //проверка на модулей на пройденность
            $modules = $course->module;
            $userStats = Stat::where('users_id', $userId)
                ->whereIn('passed_modules_id', $modules->pluck('id'))
                ->pluck('passed_modules_id')
                ->toArray();
            $courseResource->modules = $modules->map(function ($module) use ($userStats) {
                $module->passed = in_array($module->id, $userStats);
                return $module;
            });
            //
            return $courseResource;
        } else {
            return $this->error('Course not found', 404);
        }
    }

    public function moduleShow($code, $userId)
    {
        $module = Module::where('code', $code)->first();

        if ($module) {
            $moduleResource = new ModuleResource($module->loadCount('video', 'task'));

            // Проверка модуля на пройденность видео
            $videos = $module->video;
            if ($videos) {
                $userStatsVideos = Stat::where('users_id', $userId)
                    ->whereIn('passed_videos_id', $videos->pluck('id'))
                    ->pluck('passed_videos_id')
                    ->toArray();

                $moduleResource->videos = $videos->map(function ($video) use ($userStatsVideos) {
                    $video->passed = in_array($video->id, $userStatsVideos);
                    return $video;
                });
            } else {
                $moduleResource->videos = collect([]);
            }

            // Проверка модуля на пройденность тестов
            $tests = $module->test;
            if ($tests) {
                $userStatsTests = TestResult::where('users_id', $userId)
                    ->whereIn('tests_id', $tests->pluck('id'))
                    ->where('is_passed', 1) // Добавляем проверку на значение is_passed равное 1
                    ->pluck('tests_id')
                    ->toArray();

                $moduleResource->tests = $tests->map(function ($test) use ($userStatsTests) {
                    $test->passed = in_array($test->id, $userStatsTests);
                    return $test;
                });
            } else {
                $moduleResource->tests = collect([]);
            }

            return $moduleResource;
        }
        else {
            return $this->error('Module not found', 404);
        }
    }
}
