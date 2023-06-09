<?php

namespace App\Service;

use App\Events\UserAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\Language\UpdateRequest;
use App\Models\Language;
use App\Models\SwitchLang;

class SwitchLangService extends Controller
{
    public function store($data){
        event(new UserAction(auth()->user()->id, 'Добавление','Языки',$data['name']));
        SwitchLang::firstOrCreate($data);
    }

    public function update($data, SwitchLang $swithLang ){
        event(new UserAction(auth()->user()->id, 'Обновление','Языки',$data['name']));
        $swithLang->update($data);
    }
}
