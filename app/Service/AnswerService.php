<?php

namespace App\Service;

use App\Events\UserAction;
use App\Http\Controllers\Controller;
use App\Models\Answer;

class AnswerService extends Controller
{
    public function store($data){
        event(new UserAction(auth()->user()->id, 'Добавление','Ответы теста',$data['name']));
        Answer::firstOrCreate($data);
    }
    public function update($data,Answer $answer){
        event(new UserAction(auth()->user()->id, 'Добавление','Ответы теста',$data['name']));
        $answer->update($data);
    }
}
