<?php

namespace App\Service;

use App\Events\UserAction;
use App\Http\Controllers\Controller;
use App\Models\Answer;
use App\Models\Column;

class ColumnService extends Controller
{
    public function store($data){
        event(new UserAction(auth()->user()->id, 'Добавление','Колоны',$data['name']));
        Column::firstOrCreate($data);
    }
    public function update($data,Column $column){
        event(new UserAction(auth()->user()->id, 'Обновление','Колоны',$data['name']));
        $column->update($data);
    }
}
