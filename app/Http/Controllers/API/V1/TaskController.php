<?php

namespace App\Http\Controllers\API\V1;
use App\Http\Controllers\API\MainApiController;
use App\Http\Requests\TaskResult\StoreRequest;
use App\Models\Task;
use App\Models\TaskResult;


class TaskController extends MainApiController
{

    public function show($code){
        $task = Task::select('id','name','description','word','number','poster','code')->where('code',$code)->first();
        if (!$task) {
          return $this->error('There is no task with '.$code, 404);
        }
        else{
            return response()->json(['data'=>$task]);
        }
    }
    public function resultPost(StoreRequest $request){
        $data = $request->validated();
        if($data){
            TaskResult::firstOrCreate($data);
            return response()->json(['data'=>$data,'status'=>true]);
        }
        else{
            return $this->error('wrong data','404');
        }
    }
}
