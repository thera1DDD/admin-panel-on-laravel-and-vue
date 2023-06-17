<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Task\StoreRequest;
use App\Http\Requests\Task\UpdateRequest;
use App\Models\Module;
use App\Models\Task;
use App\Service\TaskService;
use Illuminate\Support\Facades\Storage;
use PhpParser\Node\Expr\AssignOp\Mod;

class TaskController extends Controller
{

    protected $taskService;
    public function __construct(TaskService $taskService)
    {
        $this->taskService = $taskService;
    }
    public function index()
    {
        $tasks = Task::all();
        return view('task.index',compact('tasks'));
    }


    public function create(){
        $modules = Module::all();
        return view('task.create',compact('modules'));
    }


    public function store(StoreRequest $request){
        $data = $request->validated();
        if ($request->hasFile('poster')) {
            $path = $request->file('poster')->store('images/categories', 'public');
            $data['poster'] = Storage::disk('public')->url($path);
        }
        $this->taskService->store($data);
        return redirect()->route('task.index')->with('success','Task created');
    }


    public function edit(Task $task){
        $modules = Module::all();
        return view('task.edit',compact('task','modules'));
    }


    public function delete(Task $task){
        $task->delete();
        return redirect()->route('task.index')->with('success','Task deleted');
    }


    public function update(UpdateRequest $request, Task $task){
        $data = $request->validated();
        if ($request->hasFile('poster')) {
            $path = $request->file('poster')->store('images/categories', 'public');
            $data['poster'] = Storage::disk('public')->url($path);
        }
        $this->taskService->update($data,$task);
        return redirect()->route('task.index')->with('success','Task updated');
    }
}
