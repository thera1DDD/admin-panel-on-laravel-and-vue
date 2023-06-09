<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Answer\StoreRequest;
use App\Http\Requests\API\Register\UpdateRequest;
use App\Models\Answer;
use App\Models\Question;
use App\Service\AnswerService;

class AnswerController extends Controller
{


    protected $answerService;

    public function __construct(AnswerService $answerService)
    {
        $this->answerService = $answerService;
    }
    public function create($id){
        $question = Question::findOrfail($id);
        return view('answer.create',compact('question'));
    }

    public function store(StoreRequest $request){
        $data = $request->validated();
        $this->answerService->store($data);
        return redirect()->route('question.show',$data['questions_id'])->with('success','Answer created');
    }

    public function edit(Answer $answer){
        $questions = Question::all();
        return view('answer.edit',compact('answer','questions'));
    }

    public function index(){
      $answers =  Answer::all();
      return view('answer.index',compact('answers'));
    }

    public function update(UpdateRequest $request,Answer $answer){
        $data = $request->validated();
        $this->answerService->update($data,$answer);
        return redirect()->route('question.show',$answer['questions_id'])->with('success','Answer updated');
    }

    public function delete(Answer $answer){
        $answer->delete();
        return redirect()->route('question.show',$answer['questions_id'])->with('success','Answer deleted');
    }
}
