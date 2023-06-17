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
        $data = $request->validated();
        if ($request->hasFile('video_file')) {
            $path = $request->file('video_file')->store('video', 'public');
            $data['video_file'] = Storage::disk('public')->url($path);
        }
        if ($request->hasFile('poster')) {
            $path = $request->file('poster')->store('video/posters', 'public');
            $data['poster'] = Storage::disk('public')->url($path);
        }
        $this->demovideoService->update($data,$demovideo);
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
        $data = $request->validated();
        if ($request->hasFile('video_file')) {
            $path = $request->file('video_file')->store('video', 'public');
            $data['video_file'] = Storage::disk('public')->url($path);
        }
        if ($request->hasFile('poster')) {
            $path = $request->file('poster')->store('video/posters', 'public');
            $data['poster'] = Storage::disk('public')->url($path);
        }
        $this->demovideoService->store($data);
        return redirect()->route('demovideo.index')->with('success','Demovideo created');
    }

    public function play($id)
    {
        $demovideo = Demovideo::findOrFail($id);
        $video_file_path = $demovideo->video_file;
        return view('demovideo.show', compact('video_file_path'));
    }
}
