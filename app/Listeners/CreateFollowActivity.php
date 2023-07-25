<?php

namespace App\Listeners;

use App\Events\NewFollowCreated;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Models\Activity;

class CreateFollowActivity
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
    public function handle(NewFollowCreated $event): void
    {
        Activity::create([
            'user_id' => $event->follow->user_id,
            'type' => 'follow',
            'target_id' => $event->follow->following_id
        ]);
    }
}
