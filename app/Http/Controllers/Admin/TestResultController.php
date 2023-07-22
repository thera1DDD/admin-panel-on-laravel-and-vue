<?php

namespace App\Http\Controllers\Admin;

use App\Events\UserAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\TestResult\StoreRequest;
use App\Http\Requests\TestResult\UpdateRequest;
use App\Models\Column;
use App\Models\Test;
use App\Models\TestResult;
use App\Models\User;
use App\Service\CategoryService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TestResultController extends Controller
{

    protected $categoryService;
    public function __construct(CategoryService $categoryService)
    {
        $this->categoryService = $categoryService;
    }
    public function index(Request $request)
    {
        $search = $request->input('search');

        $testsResults = TestResult::with('user')
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
        return view('testsResult.index', compact('testsResults', 'search'));
    }

    public function show($id)
    {
        $testsResults = TestResult::where('users_id',$id)->get();
        return view('testsResult.show', compact('testsResults'));
    }

    public function create(){
        $columns = Column::all();
        return view('category.create',compact('columns'));
    }

    public function store(StoreRequest $request){
        $data = $request->validated();
        if ($request->hasFile('poster')) {
            $path = $request->file('poster')->store('images/categories', 'public');
            $data['poster'] = Storage::disk('public')->url($path);
        }
        $this->categoryService->store($data);
        return redirect()->route('category.index')->with('success','Category created');
    }

    public function edit(TestResult $testsResult){
        $tests = Test::all();$users = User::all();
        return view('testsResult.edit',compact('testsResult','users','tests'));
    }


    public function delete(TestResult $testsResult){
        $testsResult->delete();
        return redirect()->route('testsResult.index')->with('success','Results deleted');
    }


    public function update(UpdateRequest $request, TestResult $testsResult){
        $data = $request->validated();
        $testsResult->update($data);
        return redirect()->route('testsResult.index')->with('success','Results updated');
    }


}
