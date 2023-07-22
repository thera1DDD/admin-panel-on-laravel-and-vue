<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\API\MainApiController;
use App\Http\Resources\PopularQuestion\PopularQuestionResource;
use App\Models\PopularQuestion;

class PopularQuestionController extends MainApiController
{
    public function getAll(){

        $popularQuestions = PopularQuestion::all();
        if($popularQuestions){
            return PopularQuestionResource::collection($popularQuestions);
        }
        else{
            return $this->error('questions not found',404);
        }
    }

}
