<?php

namespace App\Service;

use App\Http\Controllers\Controller;
use App\Models\Answer;
use App\Models\Favourite;

class FavouriteService extends Controller
{
    public function store($data){
        Favourite::firstOrCreate($data);
    }
    public function update($data,Favourite $favourite){
        $favourite->update($data);
    }
}
