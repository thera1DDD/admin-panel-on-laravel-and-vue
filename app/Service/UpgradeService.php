<?php

namespace App\Service;

use App\Http\Controllers\Controller;
use App\Models\Upgrade;

class UpgradeService extends Controller
{
    public function store($data){
        Upgrade::firstOrCreate($data);
    }

    public function update($data,Upgrade $upgrade){
        $upgrade->update($data);
    }
}
