<?php

namespace App\Service\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Course\StoreRequest;
use App\Http\Requests\Course\UpdateRequest;
use App\Models\Answer;
use App\Models\Course;
use App\Models\Language;
use App\Models\Question;
use Illuminate\Support\Facades\Storage;

class QuestionService extends Controller
{
    public function store(\App\Http\Requests\Question\StoreRequest $request){
        $data = $request->validated();
        Question::firstOrCreate($data);
    }
    public function update(\App\Http\Requests\Question\UpdateRequest $request,Question $question){
        $data = $request->validated();
        $question->update($data);
    }
}
