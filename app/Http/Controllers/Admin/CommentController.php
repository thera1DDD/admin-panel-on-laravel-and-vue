<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Comment\StoreRequest;
use App\Http\Requests\Comment\UpdateRequest;
use App\Models\Comment;
use App\Models\Module;
use App\Models\User;
use App\Service\CommentService;

class CommentController extends Controller
{


    protected $commentService;

    public function __construct(CommentService $commentService)
    {
        $this->commentService = $commentService;
    }
    public function create(){
        $comments = Comment::all(); $users = User::all(); $records = Module::all();
        return view('comment.create',compact('comments','users','records'));
    }

    //ajax request
    public function getRecordsByType($type)
    {
        $model = "App\Models\\" .$type;
        $records = $model::all();
        return response()->json($records);
    }

    public function edit(Comment $comment){
        $users = User::all();
        $recordsOfModel = $comment->commentable_type::all();
        return view('comment.edit',compact('comment','users','recordsOfModel'));
    }

    public function index(){
      $comments = Comment::all();
      return view('comment.index',compact('comments'));
    }

    public function update(UpdateRequest $request,Comment $comment){
        $data = $request->validated();
        $this->commentService->update($data,$comment);
        return redirect()->route('comment.index')->with('success','Comment updated');
    }
    public function store(StoreRequest $request){
        $data = $request->validated();
        $this->commentService->store($data);
        return redirect()->route('comment.index')->with('success','Comment created');
    }

    public function delete(Comment $comment){
        $comment->delete();
        return redirect()->route('comment.index')->with('success','Comment deleted');
    }
}
