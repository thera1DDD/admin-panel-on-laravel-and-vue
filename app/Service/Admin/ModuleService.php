<?php

namespace App\Service\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Course\StoreRequest;
use App\Http\Requests\Course\UpdateRequest;
use App\Models\Course;
use App\Models\Language;
use App\Models\Module;
use Illuminate\Support\Facades\Storage;

class ModuleService extends Controller
{
    public function  store(\App\Http\Requests\Module\StoreRequest $request){
        $data = $request->validated();
        $data['main_image'] = Storage::disk('public')->put('/images/modules',$data['main_image']);
        Module::firstOrCreate($data);
    }

    public function update(UpdateRequest $request,Module $module)
    {
        $data = $request->validated();
        $data['main_image'] = Storage::disk('public')->put('/images/modules',$data['main_image']);
        $module->update($data);
    }
}
