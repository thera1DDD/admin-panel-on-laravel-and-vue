<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Stat\StoreRequest;
use App\Http\Requests\Stat\UpdateRequest;
use App\Models\Course;
use App\Models\Module;
use App\Models\Stat;
use App\Models\Task;
use App\Models\Test;
use App\Models\User;
use App\Models\Video;
use App\Service\StatService;


class StatController extends Controller
{

    protected $statService;
    public function __construct(StatService $statService)
    {
        $this->statService = $statService;
    }

    public function index(){
       $stats = Stat::all();
       return view('stat.index',compact('stats'));
    }

    public function create(){
        $stats = Stat::all();$courses = Course::all(); $users = User::all();$modules = Module::all(); $videos = Video::all();$tasks = Task::all(); $tests = Test::all();
        return view('stat.create',compact('stats','users','courses','modules','videos','tasks','tests'));
    }

    public function store(StoreRequest $request){
        $data = $request->validated();
        $this->statService->store($data);
        return redirect()->route('stat.index')->with('success','Статистика пользователя добавлена');
    }


    public function edit(Stat $stat){
        $courses = Course::all(); $users = User::all(); $modules = Module::all();$videos = Video::all(); $tasks = Task::all();$tests = Test::all();
        return view('stat.edit',compact('stat','users','courses','videos','modules','tasks','tests'));
    }


    public function delete(Stat $stat){
        $stat->delete();
        return redirect()->route('stat.index')->with('success','Статистика пользователя удалена');
    }

    public function update(UpdateRequest $request, Stat $stat){
        $data = $request->validated();
        $this->statService->update($data,$stat);
        return redirect()->route('stat.index')->with('success','Статистика пользователя обновлена');
    }

}
