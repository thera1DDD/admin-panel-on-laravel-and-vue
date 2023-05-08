<?php

namespace App\Service;

use App\Http\Controllers\Controller;
use App\Http\Requests\Language\UpdateRequest;
use App\Models\Language;

class LanguageService extends Controller
{
    public function store($data){
        Language::firstOrCreate($data);
    }

    public function update($data, Language $language ){
       $language->update($data);
    }
}
