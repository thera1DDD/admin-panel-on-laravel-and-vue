<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\PopularQuestion\StoreRequest;
use App\Http\Requests\PopularQuestion\UpdateRequest;
use App\Models\PopularQuestion;
use App\Service\PopularQuestionService;

class PopularQuestionController extends Controller
{

    protected $popularQuestion;
    public function __construct(PopularQuestionService $popularQuestion)
    {
        $this->popularQuestion = $popularQuestion;
    }
    public function index()
    {
        $popularQuestions = PopularQuestion::all();
        return view('popularQuestion.index',compact('popularQuestions'));
    }

    public function create(){
        return view('popularQuestion.create');
    }

    public function store(StoreRequest $request){
        $data = $request->validated();
        $this->popularQuestion->store($data);
        return redirect()->route('popularQuestion.index')->with('success','PopularQuestion created');
    }


    public function edit(PopularQuestion $popularQuestion){
        return view('popularQuestion.edit',compact('popularQuestion'));
    }

    public function delete(PopularQuestion $popularQuestion){
        $popularQuestion->delete();
        return redirect()->route('popularQuestion.index')->with('success','PopularQuestion deleted');
    }

    public function update(UpdateRequest $request, PopularQuestion $popularQuestion){
        $data = $request->validated();
        $this->popularQuestion->update($data,$popularQuestion);
        return redirect()->route('popularQuestion.index')->with('success','PopularQuestion updated');
    }
}
