<?php

namespace App\Service;

use App\Http\Controllers\Controller;
use App\Models\Artwork;

class ArtworkService extends Controller
{
    public function store($data){
        Artwork::firstOrCreate($data);
    }

    public function update($artwork,$data){
        $artwork->update($data);
    }
}
