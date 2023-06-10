<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Module\StoreRequest;
use App\Http\Requests\Module\UpdateRequest;
use App\Models\Course;
use App\Models\Module;
use App\Service\ModuleService;
use App\Traits\ImageUploadTrait;
use Illuminate\Support\Facades\Storage;

class ModuleController extends Controller
{

    use ImageUploadTrait;
    protected $moduleService;

    public function __construct(ModuleService $moduleService)
    {
        $this->moduleService = $moduleService;
    }

    public function  index(){
        $modules = Module::all();
        return view('module.index',compact('modules'));
    }

    public function store(StoreRequest $request){
        $data = $request->validated();
        if ($request->hasFile('main_image')) {
            $file = $request->file('main_image');
            $path = $file->store('images/modules', 'public');
            $data['main_image'] = $path;
            $data['main_image'] = Storage::disk('public')->url($data['main_image']);
        }
        $this->moduleService->store($data);
        return redirect()->route('module.index')->with('success','Модуль создан');
    }

    public function create(){
        $modules = Module::all(); $courses = Course::all();
        return view('module.create',compact('modules','courses'));
    }


    public function update(UpdateRequest  $request, Module $module){
        $data = $request->validated();
        if ($request->hasFile('main_image')) {
            $file = $request->file('main_image');
            $path = $file->store('images/modules', 'public');
            $data['main_image'] = $path;
            $data['main_image'] = Storage::disk('public')->url($data['main_image']);

        }
        $this->moduleService->update($module,$data);
        return redirect()->route('module.index')->with('success','Модуль обновлен');
    }

    public function edit(Module $module){
        $courses = Course::all();
        return view('module.edit',compact('module','courses'));
    }

    public function delete(Module $module){
        $module->delete();
        return redirect()->route('module.index')->with('success','Модуль удалён');
    }
























//
//    public function show(Module $modules,Language $languages ){
//        return view('module.show',compact('module','languages'));
//    }
//

//    public function getAll(){
//        $module = Module::latest()->get();
//        $module->transform(function($module){
//            $module->module = $module->getModulNames()->first();
//            return $module;
//        });
//
//        return response()->json([
//            'users' => $module
//        ], 200);
//
//
//    }
}
