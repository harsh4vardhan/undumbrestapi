<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\AllPostsCollection;
use App\Http\Resources\UsersCollection;
use App\Models\Post;
use App\Models\User;
use App\Models\Follow;
use function Webmozart\Assert\Tests\StaticAnalysis\length;

class ProfileController extends Controller
{
    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        try {
            $posts = Post::where('user_id', $id)->orderBy('created_at', 'desc')->get();
            $user = User::where('id', $id)->get();
            $noOfFollwers = Follow::where('following_id', $id)->count();
            $noOfLikes = $this->totalNoOfLikes($posts);
            $hatColor = $this->changeHatColor($noOfLikes);
            return response()->json([
                'posts' => new AllPostsCollection($posts),
                'user' => new UsersCollection($user),
                'noOfFollwers' => $noOfFollwers,
                'hatColor' => $hatColor
            ], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 400);
        }
    }

    public function totalNoOfLikes($post) {
        if($post) {
            $allLikes = 0;
            for($i=0;$i<count($post);$i++){
                if($post[$i]->likes) {
                    $allLikes += count($post[$i]->likes);
                }
            }
            return $allLikes;
        }
    }
    public function changeHatColor($noOfLikes)
    {
        if( (0 < $noOfLikes) && ($noOfLikes < 1000)) {
            return "red";
        }
    }
}
 