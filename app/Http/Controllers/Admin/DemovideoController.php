<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Video\StoreRequest;
use App\Models\Demovideo;
use App\Models\Course;
use App\Service\Admin\DemovideoService;
use Illuminate\Http\Request;
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

    public function update(\App\Http\Requests\Demovideo\UpdateRequest  $request, Demovideo $demovideo){
        $this->demovideoService->update($request,$demovideo);
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

    public function store(\App\Http\Requests\Demovideo\StoreRequest $request)
    {
        $this->demovideoService->store($request);
        return redirect()->route('demovideo.index')->with('success','Demovideo created');
    }

    public function play($id)
    {
        $demovideo = Demovideo::findOrFail($id);
        $video_file_path = Storage::url($demovideo->video_file);
        return view('demovideo.show', compact('video_file_path'));
    }
}
