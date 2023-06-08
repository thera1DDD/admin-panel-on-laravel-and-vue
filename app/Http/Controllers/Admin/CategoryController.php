<?php

namespace App\Http\Controllers\Admin;

use App\Events\UserAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\Category\StoreRequest;
use App\Http\Requests\Category\UpdateRequest;
use App\Models\Category;
use App\Service\CategoryService;
use Illuminate\Support\Facades\Storage;

class CategoryController extends Controller
{

    protected $categoryService;
    public function __construct(CategoryService $categoryService)
    {
        $this->categoryService = $categoryService;
    }
    public function index()
    {
        $categories = Category::all();
        $types = $categories->pluck('type')->unique();
        $typeIds = $categories->pluck('id', 'type');
        return view('category.index', compact('types', 'typeIds'));
    }

    public function show($type){
        $categories = Category::where('type',$type)->get();
        return view('category.show', compact('categories',));
    }


    public function create(){
        return view('category.create');
    }


    public function store(StoreRequest $request){
        $data = $request->validated();
        if ($request->hasFile('poster')) {
            $file = $request->file('poster');
            $path = $file->store('images/categories', 'public');
            $data['poster'] = $path;
        }
        $data['poster'] = Storage::disk('public')->url($data['poster']);
        $this->categoryService->store($data);
        return redirect()->route('category.index')->with('success','Category created');
    }


    public function edit(Category $category){
        return view('category.edit',compact('category'));
    }


    public function delete(Category $category){
        $category->delete();
        return redirect()->route('category.index')->with('success','Category deleted');
    }


    public function update(UpdateRequest $request, Category $category){
        $data = $request->validated();
        if ($request->hasFile('poster')) {
            $file = $request->file('poster');
            $path = $file->store('images/categories', 'public');
            $data['poster'] = $path;
        }
        $data['poster'] = Storage::disk('public')->url($data['poster']);
        $this->categoryService->update($data,$category);
        return redirect()->route('category.index')->with('success','Category updated');
    }


}
