<?php

namespace App\Service;

use App\Http\Controllers\Controller;
use App\Models\Answer;
use App\Models\Column;

class ColumnService extends Controller
{
    public function store($data){
        Column::firstOrCreate($data);
    }
    public function update($data,Column $column){
        $column->update($data);
    }
}
