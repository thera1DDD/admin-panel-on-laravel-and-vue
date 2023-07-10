<?php

namespace App\Http\Controllers\API\V1;


use App\Http\Controllers\API\MainApiController;
use App\Http\Controllers\Controller;
use App\Http\Requests\TestResult\StoreRequest;
use App\Http\Resources\Test\SingleTestResource;
use App\Http\Resources\Test\TestResource;
use App\Http\Resources\Teacher\TeacherResource;
use App\Models\Course;
use App\Models\Teacher;
use App\Models\Test;
use App\Models\TestResult;
use Illuminate\Http\Request;

class TestController extends MainApiController
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

    public function getAllTest(){
        $test = Test::all();
        if (!$test) {
            return response()->json(['message' => 'Test not found'], 404);
        }
        return SingleTestResource::collection($test);
    }

    public function resultPost(StoreRequest $request){
        $data = $request->validated();
        if($data){
            TestResult::firstOrCreate($data);
            return response()->json(['data'=>$data,'status'=>true]);
        }
        else{
            return $this->error('wrong data','404');
        }
    }
}
