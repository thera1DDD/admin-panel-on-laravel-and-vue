<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Upgrade\StoreRequest;
use App\Http\Requests\Upgrade\UpdateRequest;
use App\Models\Upgrade;
use App\Service\UpgradeService;

class UpgradeController extends Controller
{

    protected UpgradeService $upgradeService;
    public function __construct(UpgradeService $upgradeService)
    {
        $this->upgradeService = $upgradeService;
    }
    public function index()
    {
        $upgrades = Upgrade::all();
        return view('upgrade.index',compact('upgrades'));
    }

    public function create(){
        return view('upgrade.create');
    }

    public function store(StoreRequest $request){
        $data = $request->validated();
        $this->upgradeService->store($data);
        return redirect()->route('upgrade.index')->with('success','Upgrade created');
    }


    public function edit(Upgrade $upgrade){
        return view('upgrade.edit',compact('upgrade'));
    }

    public function delete(Upgrade $upgrade){
        $upgrade->delete();
        return redirect()->route('upgrade.index')->with('success','Upgrade deleted');
    }

    public function update(UpdateRequest $request, Upgrade $upgrade){
        $data = $request->validated();
        $this->upgradeService->update($data,$upgrade);
        return redirect()->route('upgrade.index')->with('success','Upgrade updated');
    }
}
