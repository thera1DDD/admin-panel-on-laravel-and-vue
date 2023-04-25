<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Question\StoreRequest;
use App\Http\Requests\Test\UpdateRequest;
use App\Models\Answer;
use App\Models\Question;
use App\Models\Test;
use App\Service\Admin\QuestionService;
use Illuminate\Http\Request;

class QuestionController extends Controller
{

    protected $questionService;

    public function __construct(QuestionService $questionService)
    {
        $this->questionService = $questionService;
    }
    public function index(){
        $questions = Question::all();
        return view('question.index',compact('questions'));
    }

    public function create(){
       $tests = Test::all();
       return view('question.create',compact('tests'));
    }


    public function store(StoreRequest $request){
       $this->questionService->store($request);
       return redirect()->route('question.index')->with('success','Question created');
    }


    public function edit(Question $question){
        $tests = Test::all();
        return view('question.edit',compact('question','tests'));
    }

    public function update(\App\Http\Requests\Question\UpdateRequest $request,Question $question){
       $this->questionService->update($request,$question);
        return redirect()->route('question.index')->with('success','Question updated');
    }

    public function delete(Question $question){
        $question->delete();
        return redirect()->route('question.index')->with('success','Question deleted');
    }
    public function show($id){
        $question = Question::findOrFail($id);
        $answers = Answer::all()->where('questions_id','==',$question->id);
        return view('question.show', compact('answers'));
    }
}
