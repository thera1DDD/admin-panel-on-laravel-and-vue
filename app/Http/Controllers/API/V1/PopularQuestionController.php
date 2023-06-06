<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\API\MainApiController;
use App\Http\Controllers\Controller;
use App\Http\Resources\Artwork\SingleArtworkResource;
use App\Http\Resources\Course\CourseResource;
use App\Http\Resources\Course\ModuleResource;
use App\Http\Resources\PopularQuestion\PopularQuestionResource;
use App\Models\Artwork;
use App\Models\Course;
use App\Models\Module;
use App\Models\PopularQuestion;
use Illuminate\Http\Request;
use PhpParser\Node\Expr\AssignOp\Mod;

class PopularQuestionController extends MainApiController
{
    public function getAll(){
        $popularQuestions = PopularQuestion::all();
        return PopularQuestionResource::collection($popularQuestions);
    }

}
