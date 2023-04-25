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
    public function store($data){

        Comment::firstOrCreate($data);
    }
    public function update($data,Comment $comment){

        $comment->update($data);
    }
}
