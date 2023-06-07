<?php

namespace App\Service;

use App\Http\Requests\Demovideo\UpdateRequest;
use App\Models\Demovideo;
use Illuminate\Support\Facades\Storage;

class DemovideoService
{
    public function store($data){

        if ($request->hasFile('main_image')) {
            $file = $request->file('main_image');
            $path = $file->store('images/courses', 'public');
            $data['main_image'] = $path;
        }
        $data['main_image'] = Storage::disk('public')->url($data['main_image']);
        $video = new Demovideo();
        $video->poster = $data['poster'];
        $video->name = $data['name'];
        $video->description = $data['description'];
        $video->courses_id = $data['courses_id'];
        $video_file = $data['video_file'];
        $video_file_name = time() . '_' . $video_file->getClientOriginalName();
        $video_file_path = $video_file->storeAs('demovideo', $video_file_name, 'public');
        $video->video_file = $video_file_path;
        $data['video_file'] = Storage::disk('public')->url($data['video_file']);
        $video->save();


    }

    public function update(Demovideo $demovideo,$data)
    {
        $video = new Demovideo();
        $video->name = $data['name'];
        $video->description = $data['description'];
        $video->courses_id = $data['courses_id'];
        $video_file = $data['video_file'];
        $video_file_name = time() . '_' . $video_file->getClientOriginalName();
        $video_file_path = $video_file->storeAs('demovideo', $video_file_name, 'public');
        $video->video_file = $video_file_path;
        $data['video_file'] = Storage::disk('public')->url($data['video_file']);
        $video->save();
    }
}
