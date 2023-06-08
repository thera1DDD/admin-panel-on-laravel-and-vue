<?php

namespace App\Service;

use App\Http\Controllers\Controller;
use App\Models\Answer;

class ColumnService extends Controller
{
    public function store($data){
        Answer::firstOrCreate($data);
    }
    public function update($data,Answer $answer){
        $answer->update($data);
    }
}
