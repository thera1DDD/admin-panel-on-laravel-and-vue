<?php

namespace App\Http\Controllers\Admin;

use App\Events\UserAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\Category\StoreRequest;
use App\Http\Requests\Category\UpdateRequest;
use App\Models\Category;
use App\Models\Column;
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
        $locations = $categories->pluck('location')->unique();
        $locationIds = $categories->pluck('id', 'location');
        return view('category.index', compact('locations', 'locationIds'));
    }

    public function show($location){
        $categories = Category::where('location',$location)->get();
        return view('category.show', compact('categories',));
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

    public function edit(Category $category){
        $columns = Column::all();
        return view('category.edit',compact('category','columns'));
    }


    public function delete(Category $category){
        $category->delete();
        return redirect()->route('category.index')->with('success','Category deleted');
    }


    public function update(UpdateRequest $request, Category $category){
        $data = $request->validated();
        if ($request->hasFile('poster')) {
            $path = $request->file('poster')->store('images/categories', 'public');
            $data['poster'] = Storage::disk('public')->url($path);
        }
        $this->categoryService->update($data,$category);
        return redirect()->route('category.index')->with('success','Category updated');
    }


}
