<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\UsersCollection;
use App\Models\Follow;
use App\Models\User;
use Illuminate\Http\Request;

class GlobalController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function getRandomUsers(Request $request)
    {
        try {
            $suggested = User::inRandomOrder()->limit(5)->get();
            $Follwing_id = Follow::select('following_id')->where('user_id',$request->input('id'))->get();
            for($i=0;$i<count($Follwing_id);$i++) {
                $following[$i] =( User::where('id',$Follwing_id[$i]->following_id)->get())[0];
            }
            $myfile = fopen("log.txt", "w") or die("Unable to open file!");
            $txt = "John Doe\n";
            $txt = (User::where('id',$Follwing_id[0]->following_id)->get())[0];
            fwrite($myfile, $txt);
       
            fclose($myfile);
            return response()->json([
                'suggested' => new UsersCollection($suggested),
                'following' => ($following)
            ], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 400);
        }
    }
}