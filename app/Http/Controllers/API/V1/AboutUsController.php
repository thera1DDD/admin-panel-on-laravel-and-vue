<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\API\MainApiController;
use App\Models\AboutUs;

class AboutUsController extends MainApiController
{
    public function getAll(){
        $quotes = AboutUs::select('id', 'firstQuote', 'secondQuote', 'image','big_image','text_content')->get();
//        $other = AboutUs::select('big_image','text_content')->whereNotNull('big_image')->get();
        if(!$quotes){
            return $this->error('there is no quotes',404);
        }
        return response()->json(['data'=>$quotes]);
    }
}
