<?php

namespace App\Listeners;

use App\Events\UserAction;
use App\Models\Log;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class LogUserAction
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {

    }

    /**
     * Handle the event.
     *
     * @param  \App\Events\UserAction  $event
     * @return void
     */
    public function handle(UserAction $event)
    {
        $log = new Log();
        $log->action_date = now();
        $log->action_type = $event->actionType;
        $log->users_id = $event->usersId;
        $log->category = $event->category;
        $log->record = $event->record;
        $log->save();
    }
}
