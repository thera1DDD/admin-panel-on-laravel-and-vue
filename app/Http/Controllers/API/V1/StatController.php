<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\API\MainApiController;
use App\Http\Controllers\Controller;
use App\Http\Requests\Stat\StoreRequest;
use App\Http\Resources\Artwork\ArtworkResource;
use App\Http\Resources\Artwork\SingleArtworkResource;
use App\Http\Resources\Course\CourseResource;
use App\Http\Resources\Course\ModuleResource;
use App\Models\Artwork;
use App\Models\Course;
use App\Models\Module;
use App\Models\Stat;
use Illuminate\Http\Request;
use PhpParser\Node\Expr\AssignOp\Mod;

class StatController extends MainApiController
{
    public function postStat(StoreRequest $request){
        $data = $request->validated();
        $stat = Stat::create($data);
        return $stat;
    }
    public function getCourseStat($courseId, $userId){

    }
}
