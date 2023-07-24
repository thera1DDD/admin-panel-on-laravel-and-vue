<?php

namespace App\Service;

use App\Events\UserAction;
use App\Http\Controllers\Controller;
use App\Models\Answer;
use App\Models\Category;

class CategoryService extends Controller
{
    public function store($data){
        event(new UserAction(auth()->user()->id, 'Добавление','Категории',$data['name']));
        Category::firstOrCreate($data);
    }
    public function update($data,Category $category){
        event(new UserAction(auth()->user()->id, 'Обновление','Категории',$data['name']));
        $category->update($data);
    }
}
