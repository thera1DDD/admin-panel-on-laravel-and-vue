<?php

namespace App\Http\Controllers\API\V1;


use App\Http\Controllers\API\MainApiController;
use App\Http\Controllers\Controller;
use App\Http\Requests\TaskResult\StoreRequest;
use App\Http\Resources\Test\TestResource;
use App\Http\Resources\Teacher\TeacherResource;
use App\Models\Course;
use App\Models\Teacher;
use App\Models\Test;
use App\Models\TaskResult;
use Illuminate\Http\Request;

class TaskController extends MainApiController
{

    public function show($code){
        $test = Test::with('question.answer')->where('code',$code)->first();
        if (!$test) {
          return $this->error('not found',404);
        }
        else{
            return new TestResource($test);
        }
    }

    public function getAll(){
        $test = Test::with('question.answer')->get();
        if (!$test) {
            return response()->json(['message' => 'Test not found'], 404);
        }
        return TestResource::collection($test);
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
