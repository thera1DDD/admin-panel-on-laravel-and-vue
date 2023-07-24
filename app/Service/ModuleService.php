<?php

namespace App\Service;

use App\Events\UserAction;
use App\Http\Controllers\Controller;
use App\Models\Module;

class ModuleService extends Controller
{
    public function store($data){
        event(new UserAction(auth()->user()->id, 'Добавление','Модули',$data['name']));
        Module::firstOrCreate($data);
    }

    public function update(Module $module,$data)
    {
        event(new UserAction(auth()->user()->id, 'Обновление','Модули',$data['name']));
        $module->update($data);
    }
}
