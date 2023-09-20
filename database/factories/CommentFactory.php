<?php

namespace Database\Factories;

use App\Models\Post;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Comment>
 */
class CommentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $comment_id_parent = 0;
        $mainParentId =0;

        $array = ["For those who are interested in finding random paragraphs, that's exactly what this webpage provides. If both a random word and a random sentence aren't quite long enough for your needs, then a random paragraph might be the perfect solution. Once you arrive at this page, you'll see a random paragraph. If you need another one, all you need to do is click on the next paragraph button. If you happen to need several random paragraphs all at once, you can use this other paragraph generator. Below you can find a number of ways that this generator can be used.",'There are a number of reasons you may need a block of text and when you do, a random paragraph can be the perfect solution. If you happen to be a web designer and you need some random text to show in your layout, a random paragraph can be an excellent way to do this. If you"re a programmer and you need random text to test the program, using these paragraphs can be the perfect way to do this. Anyone whos in search of realistic text for a project can use one or more of these random paragraphs to fill their need.','For writers looking for a way to get their creative writing juices flowing, using a random paragraph can be a great way to do this. One of the great benefits of this tool is that nobody knows what is going to appear in the paragraph. This can be leveraged in a few different ways to force the writer to use creativity. For example, the random paragraph can be used as the beginning paragraph','For some writers, it isn"t getting the original words on paper thats the challenge, but rewriting the first and second drafts. Using the random paragraph generator can be a good way to get into a rewriting routine before beginning the project. In this case, you take the random paragraph and rewrite it so it retains the same','When it comes to writers block, often the most difficult part is simply beginning to put words to paper. One way that can often help is to write about something completely different from what youre having the writers block about. This is where a random paragraph can be quite helpful. By using this tool you can begin to chip away at the write'];
        return [
            'user_id' =>User::all()->random()->id,
            'post_id' => Post::all()->random()->id,
            'comment_id' => $comment_id_parent,
            'text' =>  $array[array_rand( $array, 1 )],
            'level' =>0,
            'main_parent_id' => $mainParentId
// password
        ];
    }
}
