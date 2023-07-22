<?php

namespace App\Http\Controllers\API\V1;


use App\Http\Controllers\API\MainApiController;
use App\Notifications\FeedbackNotification;
use Illuminate\Support\Facades\Notification;

class FeedbackController extends MainApiController
{
    protected $email = 'inbox@djigit-language.ru'; //почта для получения писем обратной связи

    public function postFeedback(\App\Http\Requests\API\Feedback\StoreRequest $request){
        $data = $request->validated();
        $notification = new FeedbackNotification($data);
        Notification::route('mail', $this->email)->notify($notification);
        return response()->json(['data'=>$data]);
    }
}
