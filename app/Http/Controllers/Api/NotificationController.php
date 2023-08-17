<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Notification;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function index(Request $request)
    {
        $notifications = Notification::with("comment", "like", "rating", "voteBy")
            ->orderBy('id', 'DESC')
            ->where("user_id", "=", $request->user()->id)->get();

        foreach ($notifications as $notification) {
            $notification = Notification::find($notification->id);

            if ($notification->has_read == 0) {
                $notification->has_read = 1;
                $notification->update();
            }
        }

        return response([
            "data" => \App\Http\Resources\Notification::collection($notifications),
        ], 200);
    }
}
