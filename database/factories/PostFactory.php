<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;
use App\Models\Post;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $urlArray = ['https://drive.google.com/uc?export=download&id=1hTyPXiT1yrOk9ZRkRhdJY29glgWeuV-A','https://drive.google.com/uc?export=download&id=1yya6oRxdXMrlJAIYFJRQKbSeLJWs_Yk2','https://drive.google.com/uc?export=download&id=1esFa_MNUoLxqrJiV8fnYzsNqa2APLHAN','https://drive.google.com/uc?export=download&id=1hTyPXiT1yrOk9ZRkRhdJY29glgWeuV-A','https://drive.google.com/uc?export=download&id=1wWsVZlXYuqDg44SjIv6dTOpC8WMacHuO','https://drive.google.com/uc?export=download&id=1hQ3d4siLO_agUzgBa0FMfUbUcVvi01iU'];
        $array = ['history','craft','music','cooking','cars'];
        return [
            'user_id' =>User::all()->random()->id,
            'title' => Str::random(10),
            'story' => $urlArray[array_rand( $array, 1 )],
            'tags' =>  $array[array_rand( $array, 1 )]
// password
        ];
    }
}
