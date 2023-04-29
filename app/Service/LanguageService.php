<?php

namespace App\Service\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Course\StoreRequest;
use App\Http\Requests\Course\UpdateRequest;
use App\Models\Course;
use App\Models\Language;
use Illuminate\Support\Facades\Storage;

class LanguageService extends Controller
{
    public function store(\App\Http\Requests\Language\StoreRequest $request){
        $data = $request->validated();
        Language::firstOrCreate($data);
    }

    public function update(\App\Http\Requests\Language\UpdateRequest $request,Language $language ){
       $data = $request->validated();
       $language->update($data);
    }
}
