<?php

namespace App\Service\Admin;

use App\Http\Requests\Video\StoreRequest;
use App\Http\Requests\Video\UpdateRequest;
use App\Models\Video;
use Illuminate\Support\Facades\Storage;

class VideoService
{
    public function store(StoreRequest $request){

        $video = new Video();
        $video->name = $request->name;
        $video->description = $request->description;
        $video->modules_id = $request->modules_id;
        $video_file = $request->file('video_file');
        $video_file_name = time() . '_' . $video_file->getClientOriginalName();
        $video_file_path = $video_file->storeAs('videos', $video_file_name, 'public');
        $video->video_file = $video_file_path;
        $video->save();

    }

    public function update(UpdateRequest $request,Video $video){
        $data = $request->validated();
        $data['video_file'] = Storage::disk('public')->put('/videos',$data['video_file']);
        $video->update($data);
    }
}
