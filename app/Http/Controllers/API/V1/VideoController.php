<?php

namespace App\Http\Controllers\API\V1;


use App\Http\Controllers\API\MainApiController;
use App\Http\Controllers\Controller;
use App\Http\Requests\TaskResult\StoreRequest;
use App\Http\Resources\Course\TaskResource;
use App\Http\Resources\Test\TestResource;
use App\Http\Resources\Teacher\TeacherResource;
use App\Models\Course;
use App\Models\Task;
use App\Models\Teacher;
use App\Models\Test;
use App\Models\TaskResult;
use App\Models\Video;
use Illuminate\Http\Request;

class VideoController extends MainApiController
{
    public function show($code){
        $video = Video::select('id','name','description','video_file','number','poster','code')->where('code',$code)->first();
        if (!$video){
            return $this->error('There is no video with '.$code, 404);
        }
        else{
            return response()->json(['data'=>$video]);
        }
    }
}
