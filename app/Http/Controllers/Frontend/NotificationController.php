<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Notification;
use App\Models\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    public function index() {
        $notifications = Notification::with("comment", "like", "rating", "voteBy")
            ->orderBy('id', 'DESC')
            ->where("user_id", "=", Auth::guard("web")->user()->id)->get();

        foreach ($notifications as $notification) {
            $notification = Notification::find($notification->id);

            if ($notification->has_read == 0) {
                $notification->has_read = 1;
                $notification->update();
            }
        }

        $leftSliders = Slider::where('key', '=', 'notification_left')->get();
        $rightSliders = Slider::where('key', '=', 'notification_right')->get();

        return view("frontend.notifications", compact("notifications", "leftSliders", "rightSliders"));
    }
}
