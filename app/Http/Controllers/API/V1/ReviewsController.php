<?php

namespace App\Http\Controllers\API\V1;
use App\Http\Controllers\API\MainApiController;
use App\Http\Resources\Reviews\ReviewResource;
use App\Models\Comment;


class ReviewsController extends MainApiController
{

    public function getAll(){
        $reviews = Comment::select('id','username','video_link','text')->get();
        if (!$reviews) {
            return response()->json(['message' => 'Reviews not found'], 404);
        }
        return ReviewResource::collection($reviews);
    }
}
