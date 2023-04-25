<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Comment\StoreRequest;
use App\Http\Requests\Comment\UpdateRequest;
use App\Models\Comment;
use App\Models\Question;
use App\Service\Admin\CommentService;
use Illuminate\Http\Request;

class CommentController extends Controller
{


    protected $commentService;

    public function __construct(CommentService $commentService)
    {
        $this->commentService = $commentService;
    }
    public function create(){
        $comments = Comment::all();
        return view('comment.create',compact('comments'));
    }

    public function store(\App\Http\Requests\Comment\StoreRequest $request){
        $data = $request->validated();
        $this->commentService->store($data);
        return redirect()->route('comment.index')->with('success','Comment created');
    }

    public function edit(Comment $comment){
        $questions = Question::all();
        return view('comment.edit',compact('comment','questions'));
    }

    public function index(){
      $comments =  Comment::all();
      return view('comment.index',compact('comments'));
    }

    public function update(UpdateRequest $request,Comment $comment){
        $data = $request->validated();
        $this->commentService->update($data,$comment);
        return redirect()->route('comment.index')->with('success','Comment updated');
    }

    public function delete(Comment $comment){
        $comment->delete();
        return redirect()->route('comment.index')->with('success','Comment deleted');
    }
}
