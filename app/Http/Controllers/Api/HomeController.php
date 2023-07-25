<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\AllPostsCollection;
use App\Models\Post;
use App\Models\User;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.   
     */
    public function index()
    {

        try {
            $key_search = [];
            $tags = $_REQUEST['tags'];
            $key_search = explode(",", $tags);
            if (count($key_search) == 1) {
                $posts = Post::where('tags', 'like', '%' . $key_search[0] . '%')->get();
            } else if (count($key_search) == 2) {
                $posts = Post::where('tags', 'like', '%' . $key_search[0] . '%')->orWhere('tags', 'like', '%' . $key_search[1] . '%')->get();
            } else if(count($key_search) == 3) {
                $posts = Post::where('tags', 'like', '%' . $key_search[0] . '%')->orWhere('tags', 'like', '%' . $key_search[1] . '%')->orWhere('tags', 'like', '%' . $key_search[2] . '%')->get();
            }else if(count($key_search) == 4) {
                $posts = Post::where('tags', 'like', '%' . $key_search[0] . '%')->orWhere('tags', 'like', '%' . $key_search[1] . '%')->orWhere('tags', 'like', '%' . $key_search[2] . '%')->orWhere('tags', 'like', '%' . $key_search[3] . '%')->get();
            }else if(count($key_search) == 5) {
                $posts = Post::where('tags', 'like', '%' . $key_search[0] . '%')->orWhere('tags', 'like', '%' . $key_search[1] . '%')->orWhere('tags', 'like', '%' . $key_search[2] . '%')->orWhere('tags', 'like', '%' . $key_search[3] . '%')->orWhere('tags', 'like', '%' . $key_search[4] . '%')->get();
            }




            return response()->json(new AllPostsCollection($posts), 200);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 400);
        }
    }
}