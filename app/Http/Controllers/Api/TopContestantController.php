<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Like;
use App\Models\User;
use Illuminate\Http\Request;

class TopContestantController extends Controller
{
    public function index(Request $request)
    {
        $users = User::has("likes")->withCount('likes')
            ->orderBy('likes_count', 'desc')
            ->take(20)
            ->get()->except($request->user()->id);

        return response()->json(\App\Http\Resources\User::collection($users), 200);
    }
}
