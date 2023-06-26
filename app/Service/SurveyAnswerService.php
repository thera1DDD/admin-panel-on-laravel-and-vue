<?php

namespace App\Service;

use App\Events\UserAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\Language\UpdateRequest;
use App\Models\Language;
use App\Models\SurveyAnswer;
use App\Models\User;

class SurveyAnswerService extends Controller
{
    public function store($data){
        event(new UserAction(auth()->user()->id, 'Добавление','Ответы опроса',$data['name']));
        SurveyAnswer::firstOrCreate($data);
    }

    public function update($data, SurveyAnswer $surveyAnswer ){
        event(new UserAction(auth()->user()->id, 'Обновление','Ответы опроса',$data['name']));
        $surveyAnswer->update($data);
    }
}
