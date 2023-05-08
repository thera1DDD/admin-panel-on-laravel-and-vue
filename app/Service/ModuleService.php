<?php

namespace App\Service;

use App\Http\Controllers\Controller;
use App\Models\Module;

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
