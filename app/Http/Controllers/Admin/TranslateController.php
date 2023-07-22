<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Translate\StoreRequest;
use App\Http\Requests\Translate\UpdateRequest;
use App\Models\Language;
use App\Models\Translate;
use App\Models\Word;
use App\Service\TranslateService;
use Illuminate\Http\Request;

class TranslateController extends Controller
{
    protected TranslateService $translateService;

    public function __construct(TranslateService $translateService)
    {
        $this->translateService = $translateService;
    }

    public function create($id){
        $languages = Language::all();
        $word = Word::all()->where('id','=',$id)->first();
        return view('translate.create', compact('word','languages'));
    }

    public function index($id){
        $word = Word::findOrFail($id);
        $translates = Translate::all()->where('words_id','==',$word->id);
        $words_id = $id;
        return view('translate.index', compact('translates','words_id'));
    }
    public function allTranslate(Request $request)
    {
        $query = $request->input('query');
        $languageId = $request->input('language');

        if ($request->has('reset')) {
            $query = null;
            $languageId = null;
        }

        $translates = Translate::query()
            ->when($languageId, function ($query, $languageId) {
                return $query->where('languages_id', $languageId);
            })
            ->when($query, function ($query, $search) {
                return $query->where('translate', 'like', '%' . $search . '%');
            })
            ->with('word')
            ->get();

        $languages = Language::pluck('name', 'id');

        return view('translate.allTranslate', compact('translates', 'languages', 'query', 'languageId'));
    }


    public function store(StoreRequest $request){
        $data =$request->validated();
        $this->translateService->store($data);
        return redirect()->route('word.index')->with('success','Перевод добавлен');
    }

    public function edit(Translate $translate){
        $languages = Language::all();
        return view('translate.edit', compact('translate','languages'));
    }

    public function update(UpdateRequest $request,Translate $translate){
        $data = $request->validated();
        $this->translateService->update($data,$translate);
        return redirect()->route('word.index')->with('success','Перевод обновлен');
    }

    public function delete(Translate $translate){
        $translate->delete();
        return redirect()->route('word.index')->with('success','Перевод удален');
    }
}
