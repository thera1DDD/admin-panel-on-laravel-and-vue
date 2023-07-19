<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\API\MainApiController;
use App\Http\Controllers\Controller;
use App\Models\AboutUs;
use Illuminate\Http\Request;

class AboutUsController extends MainApiController
{
    public function getAll(){
        $quotes = AboutUs::select('id', 'firstQuote', 'secondQuote', 'image')->get();
        if(!$quotes){
            return $this->error('there is not quotes',404);
        }
        return response()->json(['data'=>$quotes]);

    }
}
