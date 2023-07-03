<?php

namespace App\Service;

use App\Http\Controllers\Controller;
use App\Models\Comment;

class CommentService extends Controller
{
    public function store($data){
        $comment = new Comment();
        $comment->text = $data['text'];
        $comment->username = $data['username'];
        $comment->video_link = $data['video_link'];
//        $comment->users_id = $data['users_id'];
        $comment->commentable_id = $data['commentable_id'];
        $commentable_id = $data['commentable_id'];
        $commentable_type = "App\Models\\" . $data['commentable_type'];
        $model = $commentable_type::findOrFail($commentable_id);
        $comment->commentable()->associate($model);
        $comment->save();
    }


    public function update($data,$comment){
        $comment->text = $data['text'];
        $comment->username = $data['username'];
        $comment->video_link = $data['video_link'];
//        $comment->users_id = $data['users_id'];
        $comment->commentable_id = $data['commentable_id'];
        $commentable_id = $data['commentable_id'];
        $commentable_type = "App\Models\\" .$data['commentable_type'];
        $model = $commentable_type::findOrFail($commentable_id);
        $comment->commentable()->associate($model);
        $comment->update();
    }
}
