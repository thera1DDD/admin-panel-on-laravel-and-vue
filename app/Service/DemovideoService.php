<?php

namespace App\Service;

use App\Http\Requests\Demovideo\UpdateRequest;
use App\Models\Demovideo;
use Illuminate\Support\Facades\Storage;

class DemovideoService
{
    public function store($data){
        Demovideo::firstOrCreate($data);
    }

    public function update($data,Demovideo $demovideo)
    {
        $demovideo->update($data);
    }
}
