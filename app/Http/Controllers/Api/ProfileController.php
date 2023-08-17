<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Action;
use App\Models\Like;
use App\Models\Rating;
use App\Models\User;
use App\Models\UserAction;
use Illuminate\Http\Request;

class ProfileController extends Controller
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


    public function getProfile(Request $request)
    {
        $user = User::find($request->user()->id);
        $totalUserRating = round($this->getRatings($user));

        $hasLiked = Like::where("to", "=", $user->id)
            ->where("by", "=", $request->user()->id)->first();
        $hasRated = Rating::where("to", "=", $user->id)
            ->where("by", "=", $request->user()->id)->first();

        $isLikingBlock = Action::where('action', '=', "like")->first()->block;
        $isRatingBlock = Action::where('action', '=', "rate")->first()->block;

        $isUserLikingBlock = UserAction::where("user_id", "=", $request->user()->id)->first()->liking;
        $isUserVotingBlock = UserAction::where("user_id", "=", $request->user()->id)->first()->voting;
        $isUserRatingBlock = UserAction::where("user_id", "=", $request->user()->id)->first()->rating;


        return response([
            "totalUserRating" => $totalUserRating,
            "data" => new \App\Http\Resources\User($user),
            "hasLiked" => $hasLiked,
            "hasRated" => $hasRated,
            "isLikingBlock" => $isLikingBlock,
            "isRatingBlock" => $isRatingBlock,
            "isUserLikingBlock" => $isUserLikingBlock,
            "isUserVotingBlock" => $isUserVotingBlock,
            "isUserRatingBlock" => $isUserRatingBlock,
        ], 200);
    }


    public function getUserProfile(Request $request, $username)
    {
        $user = User::where("username", "=", $username)->first();
        $rating = round($this->getRatings($user));

        $hasLiked = Like::where("to", "=", $user->id)
            ->where("by", "=", $request->user()->id)->first();
        $hasRate = Rating::where("to", "=", $user->id)
            ->where("by", "=", $request->user()->id)->first();

        $isLikingBlock = Action::where('action', '=', "like")->first()->block;
        $isRatingBlock = Action::where('action', '=', "rate")->first()->block;
        $isVotingBlock = Action::where('action', '=', "vote")->first()->block;
        $isUserLikingBlock = UserAction::where("user_id", "=", $request->user()->id)->first()->liking;
        $isUserVotingBlock = UserAction::where("user_id", "=", $request->user()->id)->first()->voting;
        $isUserRatingBlock = UserAction::where("user_id", "=", $request->user()->id)->first()->rating;

        $previousUser = User::has("galleries")->where("username", "!=", $user->username)->inRandomOrder()->first();
        $nextUser = User::has("galleries")->where("username", "!=", $user->username)
            ->where("username", "!=", $previousUser->username)->inRandomOrder()->first();

        return response([
            "rating" => $rating,
            "hasLiked" => $hasLiked,
            "hasRated" => $hasRate,
            "isLikingBlock" => $isLikingBlock,
            "isRatingBlock" => $isRatingBlock,
            "isVotingBlock" => $isVotingBlock,
            "isUserLikingBlock" => $isUserLikingBlock,
            "isUserVotingBlock" => $isUserVotingBlock,
            "isUserRatingBlock" => $isUserRatingBlock,
            "previousUser" => new \App\Http\Resources\User($previousUser),
            "nextUser" => new \App\Http\Resources\User($nextUser),
            "data" => new \App\Http\Resources\User($user)
        ], 200);
    }
}
