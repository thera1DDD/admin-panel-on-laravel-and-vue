<?php

namespace App\Service;

use App\Http\Controllers\Controller;
use App\Models\Comment;

class CommentService extends Controller
{
    public function store($data)
    {
        $data['commentable_type'] = "App\Models\\" . $data['commentable_type'];
        Comment::create($data)->commentable()->associate($data['commentable_type']::findOrFail($data['commentable_id']))->save();
    }

    public function update($data, $comment)
    {
        if (isset($data['commentable_type'])) {
            $data['commentable_type'] = "App\Models\\" . $data['commentable_type'];
            $comment->commentable()->associate($data['commentable_type']::findOrFail($data['commentable_id']));
        }
        $comment->update($data);
    }
}
