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
    public function store($data){
        Module::firstOrCreate($data);
    }

    public function update(Module $module,$data)
    {
        $module->update($data);
    }
}
