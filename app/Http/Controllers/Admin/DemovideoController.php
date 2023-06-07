<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Demovideo\StoreRequest;
use App\Http\Requests\Demovideo\UpdateRequest;
use App\Models\Course;
use App\Models\Demovideo;
use App\Service\DemovideoService;
use Illuminate\Support\Facades\Storage;

class DemovideoController extends Controller
{
    protected $demovideoService;

    public function __construct(DemovideoService $demovideoService)
    {
        $this->demovideoService = $demovideoService;
    }

    public function  index(){
        $demovideos = Demovideo::all();
        return view('demovideo.index',compact('demovideos'));
    }

    public function create(){
        $demovideos = Demovideo::all();
        $courses = Course::all();
        return view('demovideo.create',compact('demovideos','courses'));
    }

    public function update(UpdateRequest $request, Demovideo $demovideo){
        $data=$request->validated();
        if ($request->hasFile('poster')) {
            $file = $request->file('poster');
            $path = $file->store('images/courses', 'public');
            $data['poster'] = $path;
        }
        $data['poster'] = Storage::disk('public')->url($data['poster']);
        $video = new Demovideo();
        $video->poster = $data['poster'];
        $video->name = $data['name'];
        $video->description = $data['description'];
        $video->courses_id = $data['courses_id'];
        $video_file = $data['video_file'];
        $video_file_name = time() . '_' . $video_file->getClientOriginalName();
        $video_file_path = $video_file->storeAs('demovideo', $video_file_name, 'public');
        $video->video_file = $video_file_path;
        $video->save();
        return redirect()->route('demovideo.index')->with('success','Demovideo updated');
    }

    public function edit(Demovideo $demovideo){
        $courses = Course::all();
        return view('demovideo.edit',compact('demovideo','courses'));
    }

    public function delete(Demovideo $demovideo){
        $demovideo->delete();
        return redirect()->route('demovideo.index')->with('success','Demovideo deleted');
    }

    public function store(StoreRequest $request)
    {
        $data=$request->validated();
        if ($request->hasFile('poster')) {
            $file = $request->file('poster');
            $path = $file->store('images/courses', 'public');
            $data['poster'] = $path;
        }
        $data['poster'] = Storage::disk('public')->url($data['poster']);
        $video = new Demovideo();
        $video->poster = $data['poster'];
        $video->name = $data['name'];
        $video->description = $data['description'];
        $video->courses_id = $data['courses_id'];
        $video_file = $data['video_file'];
        $video_file_name = time() . '_' . $video_file->getClientOriginalName();
        $video_file_path = $video_file->storeAs('demovideo', $video_file_name, 'public');
        $video->video_file = $video_file_path;
        $video->save();
        return redirect()->route('demovideo.index')->with('success','Demovideo created');
    }

    public function play($id)
    {
        $demovideo = Demovideo::findOrFail($id);
        $video_file_path = Storage::url($demovideo->video_file);
        return view('demovideo.show', compact('video_file_path'));
    }
}
