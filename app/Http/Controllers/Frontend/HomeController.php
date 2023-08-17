<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Like;
use App\Models\Slider;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index()
    {
        if (Auth::guard("web")->check()) {
            $feedUsers = User::has("galleries")
                ->where("id", "!=", Auth::guard("web")->user()->id)
                ->inRandomOrder()->get();


            $users = User::has("likes")->withCount('likes')
            ->orderBy('likes_count', 'desc')
            ->take(20)
            ->get()->except(Auth::guard("web")->id());

            $leftSliders = Slider::where('key', '=', 'profile_left')->get();
            $rightSliders = Slider::where('key', '=', 'profile_right')->get();

            return view("frontend.home", compact("feedUsers", "users", "leftSliders", "rightSliders"));
        } else {
            return redirect()->route("login");
        }
    }
}
