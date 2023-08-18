<?php

namespace App\Http\Resources;

use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class AllPostsCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public function toArray(Request $request)
    {
        return $this->collection->map(function ($post) {
            return [
                'id' => $post->id,
                'text' => $post->text,
                'video' => url('/') . $post->video,
                'tags' => $post->tags,
                'created_at' => $post->created_at->format(' M D Y'),
                'comments' => $post->comments->map(function ($comment) {
//                    $commentMaxLevel = 0;
                    if(Comment::select('level')->where('comment_id',$comment->id)->distinct()->get()) {
                        $CommentLevel= Comment::select('level')->where('id',$comment->id)->get();
                        if($CommentLevel[0]['level'] == 0) {
                            $ParentMaxLevel = Comment::select('level')->where('main_parent_id',$comment->id)->distinct()->get()->toArray();
                        } else {
                            $ParentMaxLevel = Comment::select('level')->where('main_parent_id',$comment->main_parent_id)->distinct()->get()->toArray();

                        }
//                        $commentId = Comment::select('comment_id')->where('main_parent_id',$comment->id)->distinct()->get()->toArray();
//                        $commentSelected = Comment::where('id',1);
//                        $commentMaxLevelId = [];
                        $b = 0;
                        foreach($ParentMaxLevel as $key=>$val) {
                            if ($val > $b) {
                                $b = $val['level'];
                            }
                        }

                        $max_level = ($b - $CommentLevel[0]['level']);


                    }

//                    if($commentMaxLevel !=0 ) {

////                        $commentMaxLevel = $commentMaxLevel - $comment->level;
//                    }
                    return [
                        'id' => $comment->id,

                        'parent_id' => $comment->comment_id,
                        'level_id' => $comment->level,
                        'text' => $comment->text,
                        'main_parent_id' => $comment->main_parent_id,

                        'max_level' => $max_level,
                        'noOfChildren' => Comment::where('comment_id',$comment->id)->count(),
                        'user' => [
                            'id' => $comment->user->id,
                            'name' => $comment->user->name,
                            'image' => url('/') . $comment->user->image
                        ],
                    ];
                }),
                'likes' => $post->likes->map(function ($like) {
                    return [
                        'id' => $like->id,
                        'user_id' => $like->user_id,
                        'post_id' => $like->post_id
                    ];
                }),
                'user' => [
                    'id' => $post->user->id,
                    'name' => $post->user->name,
                    'image' => url('/') . $post->user->image
                ]
            ];
        });
    }
}
