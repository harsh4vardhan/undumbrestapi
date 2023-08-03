<?php

namespace App\Http\Controllers\Api;


use App\Http\Controllers\Controller;
use App\Http\Requests\FollowUnfollowRequest;
use App\Models\Follow;
use App\Models\User;

class FollowController extends Controller {


    public function showFollowers($id)
    {
        try {
            $followers = Follow::where('id', $id)->get();
            $followers = Follow::where('user_id', $followers[0]->user_id)->get();

            $ids = $followers->map(function ($followers) {
                return $followers->id;
            });

            return response()->json([
                'data' => $followers,
                'ids' => $ids
            ], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 400);
        }
    }

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