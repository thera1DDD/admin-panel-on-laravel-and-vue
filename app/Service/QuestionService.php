<?php

namespace App\Service;

use App\Http\Controllers\Controller;
use App\Models\Question;

class QuestionService extends Controller
{
    public function store($data){
        Question::firstOrCreate($data);
    }
    public function update($data,Question $question){
        $question->update($data);
    }
}
