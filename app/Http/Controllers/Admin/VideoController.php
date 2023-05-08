<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Video\StoreRequest;
use App\Http\Requests\Video\UpdateRequest;
use App\Models\Module;
use App\Models\Video;
use App\Service\VideoService;
use Illuminate\Support\Facades\Storage;

class VideoController extends Controller
{
    protected $videoService;
    public function __construct(VideoService $videoService)
    {
        $this->videoService = $videoService;
    }

    public function  index(){
        $videos = Video::all();
        return view('video.index',compact('videos'));
    }


    public function update(UpdateRequest  $request, Video $video){
        $data = $request->validated();
        if(isset($data['video_file'])){
            $data['video_file'] = Storage::disk('public')->put('/video',$data['video_file']);
        }
        $this->videoService->update($data,$video);
        return redirect()->route('video.index')->with('success','Video created');

    }

    public function edit(Video $video){
        $modules = Module::all();
        return view('video.edit',compact('video','modules'));
    }

    public function delete(Video $video){
        $video->delete();
        return redirect()->route('video.index')->with('success','Video deleted');
    }


    public function store(StoreRequest $request)
    {   $data = $request->validated();
        $this->videoService->store($data);
        return redirect()->route('video.index')->with('success','Video created');
    }

    public function play($id)
    {
        $video = Video::findOrFail($id);
        $video_file_path = Storage::url($video->video_file);
        return view('video.show', compact('video_file_path'));
    }

    public function create(){
        $videos = Video::all();
        $modules = Module::all();
        return view('video.create',compact('videos','modules'));
    }
}
