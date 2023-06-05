<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Upgrade\StoreRequest;
use App\Http\Requests\Upgrade\UpdateRequest;
use App\Models\Upgrade;
use App\Service\PopularQuestionService;

class PopularQuestionController extends Controller
{

    protected $popoularQuestionsService;
    public function __construct(PopularQuestionService $popoularQuestionsService)
    {
        $this->popoularQuestionsService = $popoularQuestionsService;
    }
    public function index()
    {
        $popularQuestions = Upgrade::all();
        return view('popularQuestion.index',compact('popularQuestions'));
    }

    public function create(){
        return view('popularQuestion.create');
    }

    public function store(StoreRequest $request){
        $data = $request->validated();
        $this->popoularQuestionsService->store($data);
        return redirect()->route('popularQuestion.index')->with('success','Upgrade created');
    }


    public function edit(Upgrade $popularQuestion){
        return view('popularQuestion.edit',compact('popularQuestion'));
    }

    public function delete(Upgrade $popularQuestion){
        $popularQuestion->delete();
        return redirect()->route('popularQuestion.index')->with('success','Upgrade deleted');
    }

    public function update(UpdateRequest $request, Upgrade $popularQuestion){
        $data = $request->validated();
        $this->popoularQuestionsService->update($data,$popularQuestion);
        return redirect()->route('popularQuestion.index')->with('success','Upgrade updated');
    }
}
