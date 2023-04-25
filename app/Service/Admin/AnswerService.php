<?php

namespace App\Service\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Course\StoreRequest;
use App\Http\Requests\Course\UpdateRequest;
use App\Models\Answer;
use App\Models\Course;
use App\Models\Language;
use Illuminate\Support\Facades\Storage;

class AnswerService extends Controller
{
    public function store($data){

        Answer::firstOrCreate($data);
    }
    public function update($data,Answer $answer){

        $answer->update($data);
    }
}
