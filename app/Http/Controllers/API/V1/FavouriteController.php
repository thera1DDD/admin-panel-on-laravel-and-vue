<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\Favourite\FavouriteResource;
use App\Models\Favourite;

class FavouriteController extends Controller
{
    public function show($id){
        $favourite = Favourite::with('course')->where('users_id',$id)->get();
        return FavouriteResource::collection($favourite);
    }
}
