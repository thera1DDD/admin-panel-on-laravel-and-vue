<?php

namespace App\Http\Controllers\Admin;

use App\Events\UserAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\TaskResult\StoreRequest;
use App\Http\Requests\TaskResult\UpdateRequest;
use App\Models\Category;
use App\Models\Column;
use App\Models\Task;
use App\Models\Test;
use App\Models\TaskResult;
use App\Models\User;
use App\Service\CategoryService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use SebastianBergmann\CodeCoverage\Report\Xml\Tests;

class TaskResultController extends Controller
{

    public function index(Request $request)
    {
        $search = $request->input('search');

        $tasksResults = TaskResult::with('user')
            ->when($search, function ($query, $search) {
                $query->whereHas('user', function ($query) use ($search) {
                    $query->where('name', 'like', '%' . $search . '%');
                });
            })
            ->get()
            ->groupBy('users_id')
            ->map(function ($group) {
                return $group->first();
            });
        return view('tasksResult.index', compact('tasksResults', 'search'));
    }

    public function show($id)
    {
        $tasksResults = TaskResult::where('users_id',$id)->get();
        return view('tasksResult.show', compact('tasksResults'));
    }

    public function edit(TaskResult $tasksResult){
        $tasks = Task::all();$users = User::all();
        return view('tasksResult.edit',compact('tasksResult','users','tasks'));
    }


    public function delete(TaskResult $tasksResult){
        $tasksResult->delete();
        return redirect()->route('tasksResult.index')->with('success','Results deleted');
    }


    public function update(UpdateRequest $request, TaskResult $tasksResult){
        $data = $request->validated();
        $tasksResult->update($data);
        return redirect()->route('tasksResult.index')->with('success','Results updated');
    }
}
