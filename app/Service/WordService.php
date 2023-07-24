<?php

namespace App\Service;

use App\Http\Controllers\Controller;
use App\Models\Word;

class WordService extends Controller
{
    public function store($data){
        Word::firstOrCreate($data);
    }
    public function update($data,Word $word){
        $word->update($data);
    }
}
