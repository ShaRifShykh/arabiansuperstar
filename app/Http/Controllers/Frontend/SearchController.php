<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Nomination;
use App\Models\Slider;
use App\Models\User;
use App\Models\UserNomination;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SearchController extends Controller
{
    public function index(Request $request)
    {
        $q = $request->s;
        $filter = $request->filter;
        $gender = $request->gender;
        $country = $request->country;


        if ($request->filter != null || $request->country != null || $request->gender != null) {
            if (Auth::guard("web")->check()) {
                if ($request->filter == "nominations") {
                    $searchNominations = Nomination::where('name', 'LIKE', '%' . $q . '%')
                        ->pluck("id")->all();

                    $searchUserNominations = UserNomination::whereIn("nominations_id", $searchNominations)
                        ->pluck("user_id")->all();

                    $searchUsers = User::where("email_verified_at", "!=", null)
                        ->whereIn("id", $searchUserNominations)
                        ->where('country', 'LIKE', '%' . $request->country ?? null . '%')
                        ->where('gender', $request->gender ? '=' : 'LIKE', $request->gender ? $request->gender : '%'  . $request->gender ?? null . '%')
                        ->get()->except($request->user()->id);

                } else {
                    $searchUsers = User::where("email_verified_at", "!=", null)
                        ->where($request->filter ?? 'username', 'LIKE', '%' . $q . '%')
                        ->where('country', 'LIKE', '%' . $request->country ?? null . '%')
                        ->where('gender', $request->gender ? '=' : 'LIKE', $request->gender ? $request->gender : '%'  . $request->gender ?? null . '%')
                        ->get()->except($request->user()->id);
                }
            } else {
                if ($request->filter == "nominations") {
                    $searchNominations = Nomination::where('name', 'LIKE', '%' . $q . '%')
                        ->pluck("id")->all();

                    $searchUserNominations = UserNomination::whereIn("nominations_id", $searchNominations)
                        ->pluck("user_id")->all();

                    $searchUsers = User::where("email_verified_at", "!=", null)
                        ->whereIn("id", $searchUserNominations)
                        ->where('country', 'LIKE', '%' . $request->country ?? null . '%')
                        ->where('gender', $request->gender ? '=' : 'LIKE', $request->gender ? $request->gender : '%'  . $request->gender ?? null . '%')
                        ->get();
                } else {
                    $searchUsers = User::where("email_verified_at", "!=", null)
                        ->where($request->filter ?? 'username', 'LIKE', '%' . $q . '%')
                        ->where('country', 'LIKE', '%' . $request->country ?? null . '%')
                        ->where('gender', $request->gender ? '=' : 'LIKE', $request->gender ? $request->gender : '%'  . $request->gender ?? null . '%')
                        ->get();
                }
            }
        } else {
            if (Auth::guard("web")->check()) {
                $searchUsers = User::where("email_verified_at", "!=", null)
                    ->where('full_name', 'LIKE', '%' . $q . '%')
                    ->where('username', 'LIKE', '%' . $q . '%')
                    ->get()->except($request->user()->id);
            } else {
                $searchUsers = User::where("email_verified_at", "!=", null)
                    ->where('full_name', 'LIKE', '%' . $q . '%')
                    ->where('username', 'LIKE', '%' . $q . '%')
                    ->get();
            }
        }

        $leftSliders = Slider::where('key', '=', 'search_left')->get();
        $rightSliders = Slider::where('key', '=', 'search_right')->get();

        return view("frontend.search", compact("searchUsers", "q", "filter", "gender", "country", "leftSliders", "rightSliders"));
    }
}
