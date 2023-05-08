<?php

namespace App\Service;

use App\Http\Controllers\Controller;
use App\Models\Translate;
use App\Models\Word;

class TranslateService extends Controller
{
    public function store($data){
        Translate::firstOrCreate($data);
    }
    public function update($data,Translate $translate){
        $translate->update($data);
    }
}
