<?php

namespace App\Service;

use App\Events\UserAction;
use App\Http\Controllers\Controller;
use App\Models\AboutUs;

class AboutUsService extends Controller
{
    public function store($data){
        event(new UserAction(auth()->user()->id, 'Добавление','О нас',$data['firstQuote']));
        AboutUs::firstOrCreate($data);
    }

    public function update($data, AboutUs $aboutUs ){
        event(new UserAction(auth()->user()->id, 'Обновление','О нас',$data['firstQuote']));
        $aboutUs->update($data);
    }
}
