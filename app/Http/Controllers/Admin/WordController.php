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

class WordController extends Controller
{
    protected $wordService;
    public function __construct(WordService $wordService)
    {
        $this->wordService = $wordService;
    }
    public function index()
    {
        $words = Word::all();
        return view('word.index',compact('words'));

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

    public function search(Request $request){
        if(isset($_GET['query']))
        {
            $search_text = $_GET['query'];
            $searched_data = DB::table('')->where('Name','LIKE','%'.$search_text.'%');
            return view('word.index',['searched_data'=>$searched_data]);
        }
        else{
            return view('search');
        }
    }
}
