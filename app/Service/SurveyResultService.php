<?php

namespace App\Service;

use App\Events\UserAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\Language\UpdateRequest;
use App\Models\Language;
use App\Models\SurveyAnswer;
use App\Models\SurveyResult;
use App\Models\User;

class SurveyResultService extends Controller
{
    public function store($data){
        event(new UserAction(auth()->user()->id, 'Добавление','Результаты опроса',$data['name']));
        SurveyResult::firstOrCreate($data);
    }

    public function update($data, SurveyResult $surveyResult ){
        event(new UserAction(auth()->user()->id, 'Обновление','Результаты опроса',$data['name']));
        $surveyResult->update($data);
    }
}
