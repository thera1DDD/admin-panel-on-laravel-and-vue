<?php

namespace App\Http\Controllers\API\V1;


use App\Http\Controllers\API\MainApiController;
use App\Http\Controllers\Controller;
use App\Http\Requests\TestResult\StoreRequest;
use App\Http\Resources\Test\TestResource;
use App\Http\Resources\Teacher\TeacherResource;
use App\Models\Comment;
use App\Models\Course;
use App\Models\Teacher;
use App\Models\Test;
use App\Models\TestResult;
use Illuminate\Http\Request;

class ReviewsController extends MainApiController
{

    public function getAll(){
        $reviews = Comment::select('id','username','video_link','text')->get();
        if (!$reviews) {
            return response()->json(['message' => 'Reviews not found'], 404);
        }
        return response()->json(['reviews'=>$reviews]);
    }

//    public function resultPost(StoreRequest $request){
//        $data = $request->validated();
//        if($data){
//            TestResult::firstOrCreate($data);
//            return response()->json(['data'=>$data,'status'=>true]);
//        }
//        else{
//            return $this->error('wrong data','404');
//        }
//    }
}
