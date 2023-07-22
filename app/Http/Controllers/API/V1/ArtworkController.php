<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\API\MainApiController;
use App\Http\Resources\Artwork\ArtworkResource;
use App\Http\Resources\Artwork\SingleArtworkResource;
use App\Models\Artwork;

class ArtworkController extends MainApiController
{
    public function getAll(){
        $artwork = Artwork::with('language')->get();
        return ArtworkResource::collection($artwork);
    }
    public function show($id){
        $artwork = Artwork::with('language')->find($id);
        if($artwork){
            return new SingleArtworkResource($artwork);
        }
        else{
            return $this->error('artwork not found',404);
        }
    }
    public function getAllByType($type){
        $artwork = Artwork::with('language')->where('documentType',$type)->get();
        if($artwork){
            return ArtworkResource::collection($artwork);
        }
        else{
            return $this->error('artwork not found',404);
        }
    }

}
