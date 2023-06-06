<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\API\MainApiController;
use App\Http\Controllers\Controller;
use App\Http\Resources\Artwork\ArtworkResource;
use App\Http\Resources\Artwork\PopularQuestionResource;
use App\Http\Resources\Artwork\SingleArtworkResource;
use App\Http\Resources\Course\CourseResource;
use App\Http\Resources\Course\ModuleResource;
use App\Models\Artwork;
use App\Models\Course;
use App\Models\Module;
use Illuminate\Http\Request;
use PhpParser\Node\Expr\AssignOp\Mod;

class ArtworkController extends MainApiController
{
    public function getAll(){
        $artwork = Artwork::with('language')->get();
        return ArtworkResource::collection($artwork);
    }
    public function show($id){
        $artwork = Artwork::findOrFail($id)->first();
        return new SingleArtworkResource($artwork);
    }
}
