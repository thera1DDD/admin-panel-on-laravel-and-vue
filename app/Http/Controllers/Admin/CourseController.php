<?php

namespace App\Http\Controllers\Admin;

use App\Events\UserAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\Course\StoreRequest;
use App\Http\Requests\Course\UpdateRequest;
use App\Models\Course;
use App\Models\Language;
use App\Service\CourseService;
use App\Traits\ImageUploadTrait;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Storage;

class CourseController extends Controller
{

    use ImageUploadTrait;
    protected $courseService;
    public function __construct(CourseService $courseService)
    {
        $this->courseService = $courseService;
    }

    public function  index()
    {
        Carbon::setLocale('ru');
        return view('course.index',['courses' => Course::all()]);
    }

    public function store(StoreRequest $request){
        $data = $request->validated();
        if ($request->hasFile('main_image')) {
            $path = $request->file('main_image')->store('images/courses', 'public');
            $data['main_image'] = Storage::disk('public')->url($path);
        }
        $this->courseService->store($data);
        return redirect()->route('course.index')->with('success','Курс добавлен');
    }


    public function create(){
        $courses = Course::all();$languages = Language::all();
        return view('course.create',compact('courses','languages'));
    }


    public function update(UpdateRequest  $request, Course $course){
        $data = $request->validated();
        if ($request->hasFile('main_image')) {
            $path = $request->file('main_image')->store('images/courses', 'public');
            $data['main_image'] = Storage::disk('public')->url($path);
        }
        $this->courseService->update($course,$data);
        return redirect()->route('course.index')->with('success','Курс обновлён');
    }

    public function show(Course $courses,Language $languages ){
        return view('course.show',compact('courses','languages'));
    }

    public function edit(Course $course){
        $languages = Language::all();
        return view('course.edit',compact('course','languages'));
    }
    public function delete(Course $course){
        event(new UserAction(auth()->user()->id, 'Удаление','Курсы',$course['name']));
        $course->delete();
        return redirect()->route('course.index')->with('success','Курс удален');
    }
}
