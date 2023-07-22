<?php

namespace App\Http\Controllers\API\V1;


use App\Http\Controllers\API\MainApiController;
use App\Http\Requests\TestResult\StoreRequest;
use App\Http\Resources\Test\CourseResource;
use App\Http\Resources\Test\TestResource;
use App\Models\Course;
use App\Models\Test;
use App\Models\TestResult;


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
        $test = Course::with('module.test')->get();
        return CourseResource::collection($test);
    }

    public function resultPost(StoreRequest $request){
        $data = $request->validated();
        if($data){
            TestResult::addOrUpdateResult($data);
            return response()->json(['data'=>$data,'status'=>true]);
        }
        else{
            return $this->error('wrong data','404');
        }
    }
}
