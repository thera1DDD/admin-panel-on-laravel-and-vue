<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Word\StoreRequest;
use App\Http\Requests\Word\UpdateRequest;
use App\Models\Translate;
use App\Models\Word;
use App\Service\WordService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;


class WordController extends Controller
{
    protected $wordService;
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
    public function upload(Request $request)
    {
        $file = $request->file('excel_file');

        Excel::import($file, function ($rows) {
            foreach ($rows as $row) {
                Word::create([
                    'name' => $row['name'],
                ]);
            }
        });

        return redirect()->back()->with('success', 'Слова успешно импортированы.');
    }


    public function create(){
        return view('word.create');
    }


    public function store(StoreRequest $request){
        $data = $request->validated();
        $this->wordService->store($data);
        return redirect()->route('word.index')->with('success','Word created');
    }


    public function edit(Word $word){
        return view('word.edit',compact('word'));
    }

    public function delete(Word $word){
        $word->delete();
        return redirect()->route('word.index')->with('success','Word deleted');
    }

    public function update(UpdateRequest $request, Word $word){
        $data = $request->validated();
        $this->wordService->update($data,$word);
        return redirect()->route('word.index')->with('success','Word updated');
    }


}
