<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\SurveyAnswer\StoreRequest;
use App\Http\Requests\SurveyAnswer\UpdateRequest;
use App\Models\Answer;
use App\Models\SurveyAnswer;
use App\Models\SurveyQuestion;
use App\Models\Test;
use App\Service\SurveyAnswerService;
use Illuminate\Support\Facades\Storage;

class SurveyAnswersController extends Controller
{

    protected $surveyAnswersService;

    public function __construct(SurveyAnswerService $surveyAnswersService)
    {
        $this->surveyAnswersService = $surveyAnswersService;
    }
    public function index(){
        $surveyAnswers = SurveyAnswer::all();
        return view('surveyAnswer.index',compact('surveyAnswers'));
    }

    public function create($id){
       $surveyQuestions = SurveyQuestion::findOrfail($id);
       return view('surveyAnswer.create',compact('surveyQuestions'));
    }

    public function store(StoreRequest $request){

        $data = $request->validated();
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('images/surveyAnswer', 'public');
            $data['image'] = Storage::disk('public')->url($path);
        }
        $this->surveyAnswersService->store($data);
        return redirect()->route('surveyQuestion.show',$data['survey_questions_id'])->with('success','SurveyAnswer created');
    }

    public function edit(SurveyAnswer $surveyAnswer){
        $surveyQuestions = SurveyQuestion::all();
        return view('surveyAnswer.edit',compact('surveyAnswer','surveyQuestions'));
    }

    public function update(UpdateRequest $request,SurveyAnswer $surveyAnswer){
        $data = $request->validated();
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('images/surveyAnswer', 'public');
            $data['image'] = Storage::disk('public')->url($path);
        }
        $this->surveyAnswersService->update($data,$surveyAnswer);
        return redirect()->route('surveyQuestion.show',$surveyAnswer['survey_questions_id'])->with('success','SurveyAnswer updated');
    }

    public function delete(SurveyAnswer $surveyAnswer){
        $surveyAnswer->delete();
        return redirect()->route('surveyQuestion.show',$surveyAnswer['survey_questions_id'])->with('success','SurveyAnswer deleted');
    }

}
