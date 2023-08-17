<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Logic\PushNotification;
use App\Models\Like;
use App\Models\Notification;
use App\Models\User;
use Illuminate\Http\Request;

class LikeController extends Controller
{
    public function insert(Request $request, $to)
    {
        $like = new Like();
        $like->to = $to;
        $like->by = $request->user()->id;
        $like->save();

        $notification = new Notification();
        $notification->user_id = $to;
        $notification->like_id = $like->id;
        $notification->save();

        $user = User::find($to);

        $hasLiked = Like::where("to", "=", $to)
            ->where("by", "=", $request->user()->id)->first();

        $pushNotification = new PushNotification();
        $pushNotification->sendToSelect([
            $user->device_token,
        ], "Someone liked on your profile!", $request->user()->full_name . " liked on your profile.");

        return response()->json([
            "data" => new \App\Http\Resources\User($user),
            "hasLiked" => $hasLiked
        ], 200);
    }
}
