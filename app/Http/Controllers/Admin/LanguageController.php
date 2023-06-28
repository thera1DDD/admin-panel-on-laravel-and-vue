<?php

namespace App\Http\Controllers\Admin;

use App\Events\UserAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\Language\StoreRequest;
use App\Http\Requests\Language\UpdateRequest;
use App\Models\Language;
use App\Service\LanguageService;
use Illuminate\Support\Env;
use Illuminate\Support\Facades\Config;

class LanguageController extends Controller
{

    protected $languageService;
    public function __construct(LanguageService $languageService)
    {
        $this->languageService = $languageService;
    }
    public function index()
    {
        $languages = Language::all();
        return view('language.index',compact('languages'));
    }


    public function create(){
        return view('language.create');
    }


    public function store(StoreRequest $request){
        $data = $request->validated();
        $this->languageService->store($data);
        return redirect()->route('language.index')->with('success','Language created');
    }


    public function edit(Language $language){
        return view('language.edit',compact('language'));
    }


    public function delete(Language $language){
        $language->delete();
        return redirect()->route('language.index')->with('success','Language deleted');
    }


    public function update(UpdateRequest $request, Language $language){
        $data = $request->validated();
        $this->languageService->update($data,$language);
        return redirect()->route('language.index')->with('success','Language updated');
    }
}
