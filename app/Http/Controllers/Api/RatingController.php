<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Like;
use App\Models\Notification;
use App\Models\Rating;
use App\Models\User;
use Illuminate\Http\Request;

class RatingController extends Controller
{
    private function getRatings($user)
    {
        $rating = 0;

        if ($user) {
            $oneRating = Rating::where("to", "=", $user->id)->where("rating", "=", 1)->get();
            $twoRating = Rating::where("to", "=", $user->id)->where("rating", "=", 2)->get();
            $threeRating = Rating::where("to", "=", $user->id)->where("rating", "=", 3)->get();
            $fourRating = Rating::where("to", "=", $user->id)->where("rating", "=", 4)->get();
            $fiveRating = Rating::where("to", "=", $user->id)->where("rating", "=", 5)->get();
            $totalRating = Rating::where("to", "=", $user->id)->get();

            if ($totalRating->count() != 0) {
                // Average Rating (AR) = 1*a+2*b+3*c+4*d+5*e/(R)
                // a = Total 1 Star Ratings, b = Total 2 Star Ratings, c = Total 3 Star Ratings, d = Total 4 Star Ratings, e = Total 5 Star Ratings,
                $rating = ((1 * $oneRating->count()) + (2 * $twoRating->count()) + (3 * $threeRating->count()) + (4 * $fourRating->count()) + (5 * $fiveRating->count())) / $totalRating->count();
            }
        }

        return $rating;
    }

    public function addRating(Request $request, $to)
    {
        $rating = Rating::where("to", "=", $to)
            ->where("by", "=", $request->user()->id)
            ->first();

        if ($rating) {
            $rating->rating = $request->rating;
            $rating->save();
        } else {
            $rating = new Rating();
            $rating->to = $to;
            $rating->by = $request->user()->id;
            $rating->rating = $request->rating;
            $rating->save();

            $notification = new Notification();
            $notification->user_id = $to;
            $notification->rating_id = $rating->id;
            $notification->save();
        }

        $user = User::find($to);
        $hasRated = Rating::where("to", "=", $to)
            ->where("by", "=", $request->user()->id)->first();
        $rating = round($this->getRatings($user));

        return response()->json([
            "data" => new \App\Http\Resources\User($user),
            "hasRated" => $hasRated,
            "rating" => $rating,
        ], 200);
    }
}
