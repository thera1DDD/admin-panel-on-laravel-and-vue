<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Test\StoreRequest;
use App\Http\Requests\Test\UpdateRequest;
use App\Models\Answer;
use App\Models\Module;
use App\Models\Question;
use App\Models\Test;
use App\Service\Admin\TestService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PhpParser\Lexer\TokenEmulator\ReadonlyTokenEmulator;

class TestController extends Controller
{

    protected $testService;
    public function __construct(TestService $testService)
    {
        $this->testService = $testService;
    }

    public function index(){
       $tests = Test::all();
       return view('test.index',compact('tests'));
   }

   public function store(StoreRequest $request){
       Route::get('/get-model-records', function(Request $request) {
           $testableType = $request->input('testable_type');
           $modelRecords = Model::where('testable_type', $testableType)->get();
           return $modelRecords;
       });
        $this->testService->store($request);
        return redirect()->route('test.index')->with('success','Test created');
   }

   public function create(){
        $modules = Module::all();
        return view('test.create',compact('modules'));
   }

   public function show($id){
        $test = Test::findOrFail($id);
        $questions = Question::all()->where('tests_id','==',$test->id);
        return view('test.show', compact('questions'));
   }
    public function edit(Test $test){
        $modules = Module::all();
        return view('test.edit',compact('test','modules'));
    }
    public function delete(Test $test){
        $test->delete();
        return redirect()->route('test.index')->with('success','Test deleted');
    }
    public function update(UpdateRequest  $request, Test $test){
        $this->testService->update($request,$test);
        return redirect()->route('test.index')->with('success','Test updated');
    }

    public function getRecords(Request $request)
    {
        $modelName = $request->input('testable_type');
        if($modelName == "App\Models\Modules"){
            $nameModel = 'modules';
        }
        else if($modelName == "App\Models\Courses"){
            $nameModel = 'courses';
        }
        // Получить записи выбранной модели
        $records = DB::table($nameModel)->get();
        return response()->json(['records' => $records]);
    }

}
