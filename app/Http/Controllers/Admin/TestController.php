<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Test\StoreRequest;
use App\Http\Requests\Test\UpdateRequest;
use App\Models\Module;
use App\Models\Question;
use App\Models\Test;
use App\Service\TestService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TestController extends Controller
{

    protected $testService;
    public function __construct(TestService $testService)
    {
        $this->testService = $testService;
    }

    public function getRecordsByType($type)
    {
        $model = "App\Models\\" . ucfirst($type);
        $records = $model::all();
        return response()->json($records);
    }

    public function index(){
       $tests = Test::all();
       return view('test.index',compact('tests'));
   }



   public function create(){
        $modules = Module::all();
        return view('test.create',compact('modules'));
   }

   public function show($id){
        $test = Test::findOrFail($id);
        $questions = Question::all()->where('tests_id','==',$test->id);
        return view('test.show', compact('questions','id'));
   }
    public function edit(Test $test){
        $recordsOfModel = $test->testable_type::all();
        return view('test.edit',compact('test','recordsOfModel'));
    }
    public function delete(Test $test){
        $test->delete();
        return redirect()->route('test.index')->with('success','Test deleted');
    }

    public function store(StoreRequest $request){
        $data = $request->validated();
        $this->testService->store($data);
        return redirect()->route('test.index')->with('success','Test created');
    }
    public function update(UpdateRequest $request,Test $test){
        $data = $request->validated();
        $this->testService->update($data,$test);
        return redirect()->route('test.index')->with('success','Test updated');
    }



}
