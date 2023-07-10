<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\SurveyResult\StoreRequest;
use App\Http\Requests\SurveyResult\UpdateRequest;
use App\Models\Course;
use App\Models\SurveyResult;
use App\Models\TestResult;
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

    public function index(Request $request)
    {
        $search = $request->input('search');

        $surveyResults = SurveyResult::with('user')
            ->when($search, function ($query, $search) {
                $query->whereHas('user', function ($query) use ($search) {
                    $query->where('name', 'like', '%' . $search . '%');
                });
            })
            ->get()
            ->groupBy('users_id')
            ->map(function ($group) {
                return $group->first();
            });
        return view('surveyResult.index', compact('surveyResults', 'search'));
    }

    public function show($id)
    {
        $surveyResults = SurveyResult::where('users_id',$id)->get();
        return view('surveyResult.show', compact('surveyResults'));
    }

    public function create(){
        $surveyResults = SurveyResult::all();$courses = Course::all(); $users = User::all();
        return view('surveyResult.create',compact('surveyResults','users','courses'));
    }

    public function store(StoreRequest $request){
        $data = $request->validated();
        $this->surveyResultService->store($data);
        return redirect()->route('surveyResult.index')->with('успешно','Результаты пользователя добавлены');
    }


    public function edit(SurveyResult $surveyResult){
        $courses = Course::all(); $users = User::all();
        return view('surveyResult.edit',compact('surveyResult','users','courses'));
    }


    public function delete(SurveyResult $surveyResult){
        $surveyResult->delete();
        return redirect()->route('surveyResult.index')->with('success','Результаты пользователя удалены');
    }

    public function update(UpdateRequest $request, SurveyResult $surveyResult){
        $data = $request->validated();
        $this->surveyResultService->update($data,$surveyResult);
        return redirect()->route('surveyResult.index')->with('success','Результаты пользователя обновлены');
    }
}
