<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Like;
use App\Models\User;
use Illuminate\Http\Request;

class FeedController extends Controller
{
    public function index(Request $request)
    {
        $feedUsers = User::has("galleries")
            ->where("id", "!=", $request->user()->id)
            ->inRandomOrder()->paginate(10);

        return response()->json(\App\Http\Resources\User::collection($feedUsers), 200);
    }
}
