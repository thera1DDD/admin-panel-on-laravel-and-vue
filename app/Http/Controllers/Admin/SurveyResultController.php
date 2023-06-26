<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\SurveyResult\StoreRequest;
use App\Http\Requests\SurveyResult\UpdateRequest;
use App\Models\Course;
use App\Models\SurveyResult;
use App\Models\User;
use App\Service\SurveyResultService;
use Illuminate\Http\Request;

class SurveyResultController extends Controller
{


    protected $surveyResultService;
    public function __construct(SurveyResultService $surveyResultService)
    {
        $this->surveyResultService = $surveyResultService;
    }

    public function index(){
       $surveyResults = SurveyResult::all();
       return view('surveyResult.index',compact('surveyResults'));
    }

    public function create(){
        $surveyResults = SurveyResult::all();$courses = Course::all(); $users = User::all();
        return view('surveyResult.create',compact('surveyResults','users','courses'));
    }

    public function store(StoreRequest $request){
        $data = $request->validated();
        $this->surveyResultService->store($data);
        return redirect()->route('surveyResult.index')->with('успешно','Избранное пользователя добавлено');
    }


    public function edit(SurveyResult $surveyResult){
        $courses = Course::all(); $users = User::all();
        return view('surveyResult.edit',compact('surveyResult','users','courses'));
    }


    public function delete(SurveyResult $surveyResult){
        $surveyResult->delete();
        return redirect()->route('surveyResult.index')->with('success','Избранное пользователя удалено');
    }

    public function update(UpdateRequest $request, SurveyResult $surveyResult){
        $data = $request->validated();
        $this->surveyResultService->update($data,$surveyResult);
        return redirect()->route('surveyResult.index')->with('success','Избранное пользователя обновлено');
    }

}
