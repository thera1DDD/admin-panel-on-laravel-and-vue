<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Module\StoreRequest;
use App\Http\Requests\Module\UpdateRequest;
use App\Models\Course;
use App\Models\Module;
use App\Service\ModuleService;
use App\Traits\ImageUploadTrait;

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
        $this->uploadImage($data['main_image'],'/images/modules', false,'public');
        $this->moduleService->store($data);
        return redirect()->route('module.index')->with('success','Module created');
    }

    public function create(){
        $modules = Module::all(); $courses = Course::all();
        return view('module.create',compact('modules','courses'));
    }


    public function update(UpdateRequest  $request, Module $module){
        $data = $request->validated();
        if($request->main_image!==null){
            $this->uploadImage($data['main_image'],'/images/modules', false,'public');
        }
        $this->moduleService->update($module,$data);
        return redirect()->route('course.index')->with('success','Course updated');
    }

    public function edit(Module $module){
        $courses = Course::all();
        return view('module.edit',compact('module','courses'));
    }

    public function delete(Module $module){
        $module->delete();
        return redirect()->route('module.index')->with('success','Module deleted');
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
