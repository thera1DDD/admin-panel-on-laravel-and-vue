<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AboutUs\StoreRequest;
use App\Http\Requests\AboutUs\UpdateRequest;
use App\Models\AboutUs;
use App\Service\AboutUsService;
use Illuminate\Support\Facades\Storage;

class AboutUsController extends Controller
{

    protected $aboutUsService;
    public function __construct(AboutUsService $aboutUsService)
    {
        $this->aboutUsService = $aboutUsService;
    }
    public function index()
    {
        $aboutUss = AboutUs::all();
        return view('aboutUs.index',compact('aboutUss'));
    }


    public function create(){
        return view('aboutUs.create');
    }


    public function store(StoreRequest $request){
        $data = $request->validated();
        if ($request->hasFile('big_image')) {
            $path = $request->file('big_image')->store('images/aboutUs', 'public');
            $data['big_image'] = Storage::disk('public')->url($path);
        }
        $this->aboutUsService->store($data);
        return redirect()->route('aboutUs.index')->with('success','Успешно созданно');
    }


    public function edit(AboutUs $aboutUs){
        return view('aboutUs.edit',compact('aboutUs'));
    }


    public function delete(AboutUs $aboutUs){
        $aboutUs->delete();
        return redirect()->route('aboutUs.index')->with('success','Успешно удаленно');
    }


    public function update(UpdateRequest $request, AboutUs $aboutUs){
        $data = $request->validated();
        if ($request->hasFile('big_image')) {
            $path = $request->file('big_image')->store('images/aboutUs', 'public');
            $data['big_image'] = Storage::disk('public')->url($path);
        }
        $this->aboutUsService->update($data,$aboutUs);
        return redirect()->route('aboutUs.index')->with('success','Успешно обновленно');
    }
}
