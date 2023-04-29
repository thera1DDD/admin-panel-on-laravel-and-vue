<?php

namespace App\Service\Admin;

use App\Http\Requests\Demovideo\UpdateRequest;
use App\Http\Requests\Video\StoreRequest;
use App\Models\Demovideo;
use http\Env\Request;
use Illuminate\Support\Facades\Storage;

class DemovideoService
{
    public function store(\App\Http\Requests\Demovideo\StoreRequest $request){

        $video = new Demovideo();
        $video->name = $request->name;
        $video->description = $request->description;
        $video->courses_id = $request->courses_id;
        $video_file = $request->file('video_file');
        $video_file_name = time() . '_' . $video_file->getClientOriginalName();
        $video_file_path = $video_file->storeAs('demovideo', $video_file_name, 'public');
        $video->video_file = $video_file_path;
        $video->save();

    }

    public function update(UpdateRequest $request, Demovideo $demovideo)
    {
        $data = $request->validated();
        $data['video_file'] = Storage::disk('public')->put('/demovideo',$data['video_file']);
        $demovideo->update($data);
    }
}
