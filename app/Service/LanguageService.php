<?php

namespace App\Service;

use App\Events\UserAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\Language\UpdateRequest;
use App\Models\Language;

class LanguageService extends Controller
{
    public function store($data){
        event(new UserAction(auth()->user()->id, 'Добавление','Языки',$data['name']));
        Language::firstOrCreate($data);
    }

    public function update($data, Language $language ){
        event(new UserAction(auth()->user()->id, 'Обновление','Языки',$data['name']));
        $language->update($data);
    }
}
