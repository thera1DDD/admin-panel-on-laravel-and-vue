<?php

namespace App\Http\Controllers\Admin;

use App\Events\UserAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\SurveyQuestion\StoreRequest;
use App\Http\Requests\SurveyQuestion\UpdateRequest;
use App\Models\SurveyAnswer;
use App\Models\SurveyQuestion;
use App\Service\SurveyQuestionService;

class SurveyQuestionController extends Controller
{

    protected $surveyQuestionService;
    public function __construct(SurveyQuestionService $surveyQuestionService)
    {
        $this->surveyQuestionService = $surveyQuestionService;
    }
    public function index()
    {
        $surveyQuestions = SurveyQuestion::all();
        return view('surveyQuestion.index',compact('surveyQuestions'));
    }


    public function create(){
        return view('surveyQuestion.create');
    }


    public function store(StoreRequest $request){
        $data = $request->validated();
        $this->surveyQuestionService->store($data);
        return redirect()->route('surveyQuestion.index')->with('success','SurveyQuestion created');
    }


    public function edit(SurveyQuestion $surveyQuestion){
        return view('surveyQuestion.edit',compact('surveyQuestion'));
    }


    public function delete(SurveyQuestion $surveyQuestion){
        $surveyQuestion->delete();
        return redirect()->route('surveyQuestion.index')->with('success','SurveyQuestion deleted');
    }


    public function update(UpdateRequest $request, SurveyQuestion $surveyQuestion){
        $data = $request->validated();
        $this->surveyQuestionService->update($data,$surveyQuestion);
        return redirect()->route('surveyQuestion.index')->with('success','SurveyQuestion updated');
    }
    public function show($id){
        $surveyQuestion = SurveyQuestion::findOrFail($id);
        $surveyAnswers = SurveyAnswer::all()->where('survey_questions_id','==',$surveyQuestion->id);
        return view('surveyQuestion.show', compact('surveyAnswers','id'));
    }
}
