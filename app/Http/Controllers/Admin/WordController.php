<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Word\ImportRequest;
use App\Http\Requests\Word\StoreRequest;
use App\Http\Requests\Word\UpdateRequest;
use App\Models\Language;
use App\Models\Translate;
use App\Models\Word;
use App\Service\WordService;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;


class WordController extends Controller
{
    protected WordService $wordService;
    public function __construct(WordService $wordService)
    {
        $this->wordService = $wordService;
    }
    public function index(Request $request)
    {
        $words = Word::query();
        if ($request->has('query')) {
            $query = $request->input('query');
            $words->where('name', 'like', "%{$query}%");
        }
        $words = $words->get();
        return view('word.index', ['words' => $words]);
    }


    public function import(ImportRequest $request)
    {
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $rows = Excel::toCollection(null, $file)->flatten(1);
            foreach ($rows as [$wordName, $wordTranslate, $languageName]) {
                $language = Language::firstOrCreate(['name' => $languageName]);
                $word = Word::firstOrCreate(['name' => $wordName]);

                if (!Translate::where('words_id', $word->id)->where('languages_id', $language->id)->where('translate',$wordTranslate)->exists()) {
                    Translate::create([
                        'words_id' => $word->id,
                        'translate' => $wordTranslate,
                        'languages_id' => $language->id,
                    ]);
                }
            }
        }
        return redirect()->back()->with('success', 'Импорт данных успешно выполнен.');
    }

    public function create(){
        return view('word.create');
    }


    public function store(StoreRequest $request){
        $data = $request->validated();
        $this->wordService->store($data);
        return redirect()->route('word.index')->with('success','Добавлено слово');
    }


    public function edit(Word $word){
        return view('word.edit',compact('word'));
    }

    public function delete(Word $word){
        $word->delete();
        return redirect()->route('word.index')->with('success','Слово удаленно!');
    }

    public function update(UpdateRequest $request, Word $word){
        $data = $request->validated();
        $this->wordService->update($data,$word);
        return redirect()->route('word.index')->with('success','Word updated');
    }


}
