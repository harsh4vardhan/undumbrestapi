<?php

namespace App\Listeners;

use App\Events\NewFollowCreated;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Models\User;
use App\Notifications\NewFollow;

class CreateUserFollowNotification
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(NewFollowCreated $event)
    {
        $user = User::findOrFail($event->follow->following_id);
        $user->notify(new NewFollow($event->follow));
    }
}