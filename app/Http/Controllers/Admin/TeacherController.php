<?php

namespace App\Http\Controllers\Admin;

use App\Events\UserAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\Teacher\StoreRequest;
use App\Http\Requests\Teacher\UpdateRequest;
use App\Models\Teacher;
use App\Models\User;
use App\Service\TeacherService;

class TeacherController extends Controller
{

    protected $teacherService;
    public function __construct(TeacherService $teacherService)
    {
        $this->teacherService = $teacherService;
    }
    public function index()
    {
        $teachers = Teacher::all();
        return view('teacher.index',compact('teachers'));
    }


    public function create(){
        $users = User::all();
        return view('teacher.create',compact('users'));
    }


    public function store(StoreRequest $request){
        $data = $request->validated();
        $this->teacherService->store($data);

        return redirect()->route('teacher.index')->with('success','Teacher created');
    }


    public function edit(Teacher $teacher){
        $users = User::all();
        return view('teacher.edit',compact('teacher','users'));
    }


    public function delete(Teacher $teacher){
        $teacher->delete();
        return redirect()->route('teacher.index')->with('success','Teacher deleted');
    }


    public function update(UpdateRequest $request, Teacher $teacher){
        $data = $request->validated();
        $this->teacherService->update($data,$teacher);
        return redirect()->route('teacher.index')->with('success','Teacher updated');
    }
}
