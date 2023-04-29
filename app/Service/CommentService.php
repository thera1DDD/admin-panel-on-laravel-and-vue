<?php

namespace App\Service\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Course\StoreRequest;
use App\Http\Requests\Course\UpdateRequest;
use App\Models\Answer;
use App\Models\Comment;
use App\Models\Course;
use App\Models\Language;
use Illuminate\Support\Facades\Storage;

class CommentService extends Controller
{
    public function store(\App\Http\Requests\Comment\StoreRequest $request){
        $comment = new Comment();
        $comment->text = $request->text;
        $comment->users_id = $request->users_id;
        $comment->commentable_id = $request->commentable_id;
        $commentable_id = $request->commentable_id;
        $commentable_type = "App\Models\\" . ucfirst($request->commentable_type);//поменять
        $model = $commentable_type::findOrFail($commentable_id);
        $comment->commentable()->associate($model);
        $comment->save();
    }


    public function update($request,Comment $comment){
        $comment->text = $request->text;
        $comment->users_id = $request->users_id;
        $comment->commentable_id = $request->commentable_id;
        $commentable_id = $request->commentable_id;
        $commentable_type = "App\Models\\" .$request->commentable_type;
        $model = $commentable_type::findOrFail($commentable_id);
        $comment->commentable()->associate($model);
        $comment->update();
    }
}
