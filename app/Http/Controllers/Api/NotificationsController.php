<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class NotificationsController extends Controller
{
    public function index(Request $request) {
        $notifications = [];
        foreach(auth()->user()->unreadNotifications as $notification) {
            $notification->markAsRead();

            if($notification['type'] == "App\Notifications\NewFollow") {
                $notifications[] = [
                    'type' => 'follow',
                    'user' => User::findOrFail($notification['data']['follower_id'])
                ];
            }
        }

        return response()->json($notifications);
    }
}
