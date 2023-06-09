<?php

namespace App\Http\Controllers\Admin;

use App\Events\UserAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\SwitchLang\StoreRequest;
use App\Http\Requests\SwitchLang\UpdateRequest;
use App\Models\SwitchLang;
use App\Service\SwitchLangService;

class SwitchController extends Controller
{

    protected $switchService;
    public function __construct(SwitchLangService $switchService)
    {
        $this->switchService = $switchService;
    }

    public function index()
    {
        $switchLangs = SwitchLang::all();
        return view('switch.index',compact('switchLangs'));
    }


    public function create(){
        return view('switch.create');
    }


    public function store(StoreRequest $request){
        $data = $request->validated();
        $this->switchService->store($data);

        return redirect()->route('switchLang.index')->with('success','SwitchLang created');
    }


    public function edit(SwitchLang $switchLang){
        return view('switch.edit',compact('switchLang'));
    }


    public function delete(SwitchLang $switchLang){
        $switchLang->delete();
        return redirect()->route('switchLang.index')->with('success','SwitchLang deleted');
    }


    public function update(UpdateRequest $request, SwitchLang $switchLang){
        $data = $request->validated();
        $this->switchService->update($data,$switchLang);
        return redirect()->route('switchLang.index')->with('success','SwitchLang updated');
    }
}
