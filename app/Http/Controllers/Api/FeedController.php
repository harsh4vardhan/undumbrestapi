<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Activity;

class FeedController extends Controller
{
    public function index(Request $request) {
        return response()->json(
            Activity::with(['user', 'target'])->latest()->get()
        );
    }
}
