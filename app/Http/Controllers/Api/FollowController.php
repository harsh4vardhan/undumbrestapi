<?php

namespace App\Http\Controllers\Api;


use App\Http\Controllers\Controller;
use App\Http\Requests\FollowUnfollowRequest;
use App\Models\User;

class FollowController extends Controller {

    public function follow(FollowUnfollowRequest $request) {
        error_log("reach controller");
        $request->validate(['user_id' => 'required']);
        
        $userToFollow = User::findOrFail(request('user_id'));
        auth()->user()->follow($userToFollow);

        return response()->noContent(200);
    }

    public function unfollow(FollowUnfollowRequest $request) {
        $userToUnfollow = User::findOrFail(request('user_id'));
        auth()->user()->unfollow($userToUnfollow);

        return response()->noContent(200);
    }
}