<?php

namespace App\Http\Controllers\API\V1;


use App\Http\Controllers\API\MainApiController;
use App\Models\Video;

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
