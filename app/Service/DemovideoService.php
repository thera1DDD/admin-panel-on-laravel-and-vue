<?php

namespace App\Service;

use App\Events\UserAction;
use App\Http\Requests\Demovideo\UpdateRequest;
use App\Models\Demovideo;
use Illuminate\Support\Facades\Storage;

class DemovideoService
{
    public function store($data){
        event(new UserAction(auth()->user()->id, 'Добавление','Демовидео',$data['name']));
        Demovideo::firstOrCreate($data);
    }

    public function update($data,Demovideo $demovideo) {
        event(new UserAction(auth()->user()->id, 'Обновление','Демовидео',$data['name']));
        $demovideo->update($data);
    }
}
