<?php

namespace App\Service;

use App\Events\UserAction;
use App\Http\Controllers\Controller;
use App\Models\Artwork;

class ArtworkService extends Controller
{
    public function store($data){
        event(new UserAction(auth()->user()->id, 'Добавление','Произведения',$data['name']));
        Artwork::firstOrCreate($data);
    }

    public function update($artwork,$data){
        event(new UserAction(auth()->user()->id, 'Обновление','Произведения',$data['name']));
        $artwork->update($data);
    }
}
