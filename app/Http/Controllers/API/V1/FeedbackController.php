<?php

namespace App\Http\Controllers\API\V1;


use App\Http\Controllers\API\MainApiController;
use App\Http\Controllers\Controller;
use App\Http\Requests\TestResult\StoreRequest;
use App\Http\Resources\Test\TestResource;
use App\Http\Resources\Teacher\TeacherResource;
use App\Models\Comment;
use App\Models\Course;
use App\Models\Teacher;
use App\Models\Test;
use App\Models\TestResult;
use App\Notifications\FeedbackNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;

class FeedbackController extends MainApiController
{
    protected $email = 'tagir566666@gmail.com'; //почта для получения писем обратной связи

    public function postFeedback(\App\Http\Requests\API\Feedback\StoreRequest $request){
        $data = $request->validated();
        $notification = new FeedbackNotification($data);
        Notification::route('mail', $this->email)->notify($notification);
        return response()->json(['data'=>$data]);
    }
}
