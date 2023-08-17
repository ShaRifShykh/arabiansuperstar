<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Notification;
use App\Models\Rating;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RatingController extends Controller
{
    public function add(Request $request, $to) {
        $rating = Rating::where("to", "=", $to)
            ->where("by", "=", Auth::guard("web")->user()->id)
            ->first();

        if ($rating) {
            $rating->rating = $request->rating;
            $rating->save();
        } else {
            $rating = new Rating();
            $rating->to = $to;
            $rating->by = Auth::guard("web")->user()->id;
            $rating->rating = $request->rating;
            $rating->save();

            $notification = new Notification();
            $notification->user_id = $to;
            $notification->rating_id = $rating->id;
            $notification->save();
        }

        return redirect()->back();
    }
}
