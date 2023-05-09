<?php

namespace App\Service;

use App\Http\Controllers\Controller;
use App\Http\Requests\Language\UpdateRequest;
use App\Models\Language;
use App\Models\Task;

class TaskService extends Controller
{
    public function store($data){
        Task::firstOrCreate($data);
    }

    public function update($data, Task $task ){
       $task->update($data);
    }
}
