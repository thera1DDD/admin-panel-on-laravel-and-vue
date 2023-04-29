<?php

namespace App\Service;

use App\Http\Requests\Video\StoreRequest;
use App\Http\Requests\Video\UpdateRequest;
use App\Models\Demovideo;
use App\Models\Video;
use Illuminate\Support\Facades\Storage;

class VideoService
{
    public function store($data){
        $video = new Video();
        $video->name = $data['name'];
        $video->description = $data['description'];
        $video->modules_id = $data['modules_id'];
        $video_file = $data['video_file'];
        $video_file_name = time() . '_' . $video_file->getClientOriginalName();
        $video_file_path = $video_file->storeAs('video', $video_file_name, 'public');
        $video->video_file = $video_file_path;
        $video->save();

    }

    public function update($data,Video $video){

        $video->update($data);
    }
}
