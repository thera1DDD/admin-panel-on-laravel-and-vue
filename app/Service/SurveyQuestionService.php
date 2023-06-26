<?php

namespace App\Service;

use App\Events\UserAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\Language\UpdateRequest;
use App\Models\Language;
use App\Models\SurveyQuestion;
use App\Models\User;

class SurveyQuestionService extends Controller
{
    public function store($data){
        event(new UserAction(auth()->user()->id, 'Добавление','Вопросы опроса',$data['name']));
        SurveyQuestion::firstOrCreate($data);
    }

    public function update($data, SurveyQuestion $surveyQuestion ){
        event(new UserAction(auth()->user()->id, 'Обновление','Вопросы опроса',$data['name']));
        $surveyQuestion->update($data);
    }
}
