<?php

namespace App\Service;

use App\Http\Controllers\Controller;
use App\Models\Answer;
use App\Models\Category;

class CategoryService extends Controller
{
    public function store($data){
        Category::firstOrCreate($data);
    }
    public function update($data,Category $category){
        $category->update($data);
    }
}
