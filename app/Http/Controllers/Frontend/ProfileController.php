<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Action;
use App\Models\Like;
use App\Models\Rating;
use App\Models\Slider;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

    public function index()
    {
        $user = Auth::guard("web")->user();
        $rating = $this->getRatings($user);

        $hasLiked = Like::where("to", "=", $user->id)
            ->where("by", "=", Auth::guard("web")->user()->id)->first();
        $myRating = Rating::where("to", "=", $user->id)
            ->where("by", "=", Auth::guard("web")->user()->id)->first();

        $liking = Action::where('action', '=', "like")->first();
        $rate = Action::where('action', '=', "rate")->first();

        $leftSliders = Slider::where('key', '=', 'profile_left')->get();
        $rightSliders = Slider::where('key', '=', 'profile_right')->get();

        $previousUser = User::has("galleries")->where("username", "!=", $user->username)->inRandomOrder()->first();
        $nextUser = User::has("galleries")->where("username", "!=", $user->username)
            ->where("username", "!=", $previousUser->username)->inRandomOrder()->first();

        return view("frontend.profile", compact("user", "rating", "leftSliders", "rightSliders", "previousUser", "nextUser", "hasLiked", "liking", "rate", "myRating"));
    }

    public function usersProfile($username)
    {
        if ($username == Auth::guard("web")->user()->username) {
            return redirect()->route("profile");
        }

        $user = User::where("username", "=", $username)->first();
        $rating = $this->getRatings($user);

        $hasLiked = Like::where("to", "=", $user->id)
            ->where("by", "=", Auth::guard("web")->user()->id)->first();
        $myRating = Rating::where("to", "=", $user->id)
            ->where("by", "=", Auth::guard("web")->user()->id)->first();

        $liking = Action::where('action', '=', "like")->first();
        $rate = Action::where('action', '=', "rate")->first();
        $voting = Action::where('action', '=', "vote")->first();

        $leftSliders = Slider::where('key', '=', 'profile_left')->get();
        $rightSliders = Slider::where('key', '=', 'profile_right')->get();

        $previousUser = User::has("galleries")->where("username", "!=", $user->username)->inRandomOrder()->first();
        $nextUser = User::has("galleries")->where("username", "!=", $user->username)
            ->where("username", "!=", $previousUser->username)->inRandomOrder()->first();

        return view("frontend.usersprofile", compact("myRating", "rightSliders", "leftSliders", "user", "rating", "hasLiked", "liking", "rate", "voting", "previousUser", "nextUser"));
    }

    public function usersShareProfile($username)
    {
        if (Auth::guard("web")->check()) {
            return redirect()->route("profile");
        }

        $user = User::where("username", "=", $username)->first();
        $rating = $this->getRatings($user);

        $hasLiked = Like::where("to", "=", $user->id)->first();

        $leftSliders = Slider::where('key', '=', 'profile_left')->get();
        $rightSliders = Slider::where('key', '=', 'profile_right')->get();

        $previousUser = User::where("username", "!=", $user->username)->inRandomOrder()->first();
        $nextUser = User::where("username", "!=", $user->username)
            ->where("username", "!=", $previousUser->username)->inRandomOrder()->first();

        return view("frontend.usersprofile", compact("leftSliders", "rightSliders", "user", "rating", "hasLiked", "nextUser", "previousUser"));
    }
}
