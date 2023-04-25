<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Course\StoreRequest;
use App\Http\Requests\Course\UpdateRequest;
use App\Models\Course;
use App\Models\Language;
use App\Service\Admin\CourseService;
use App\Traits\ImageUploadTrait;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class CourseController extends Controller
{


    use ImageUploadTrait;
    protected $courseService;
    public function __construct(CourseService $courseService)
    {
        $this->courseService = $courseService;
    }

    public function  index(){
        $courses = Course::all();
        return view('course.index',compact('courses'));
    }

    public function store(StoreRequest $request){
        $data = $request->validated();
        $this->uploadImage($data['main_image'],'/images/courses', false,'public');
        $this->courseService->store($data);
        return redirect()->route('course.index')->with('success','Course created');
    }


    public function create(){
        $courses = Course::all();$languages = Language::all();
        return view('course.create',compact('courses','languages'));
    }


    public function update(UpdateRequest  $request, Course $course){
        $this->courseService->update($request,$course);
        return redirect()->route('course.index')->with('success','Course updated');
    }

    public function show(Course $courses,Language $languages ){
        return view('course.show',compact('courses','languages'));
    }

    public function edit(Course $course){
        $languages = Language::all();
        return view('course.edit',compact('course','languages'));
    }
    public function delete(Course $course){
        $course->delete();
        return redirect()->route('course.index')->with('success','Course deleted');
    }

























//    public function getAll(){
//        $courses = Course::latest()->get();
//        $courses->transform(function($course){
//            $course->module = $course->getModulNames()->first();
//            return $course;
//        });
//
//        return response()->json([
//            'users' => $courses
//        ], 200);
//
//
//    }
}
