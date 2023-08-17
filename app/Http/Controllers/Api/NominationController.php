<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Nomination;
use App\Models\User;
use App\Models\UserNomination;
use Illuminate\Http\Request;

class NominationController extends Controller
{
    public function index(Request $request)
    {
        $user = User::find($request->user()->id);
        $nominations = Nomination::where("gender", "=", $user->gender)
            ->orWhere("gender", "=", "Both")->where('block', '=', 0)->get();

        return response()->json([
            "data" => \App\Http\Resources\Nomination::collection($nominations)
        ], 200);
    }


    public function maleNominations(Request $request)
    {
        $nominations = Nomination::where("gender", "=", "Male")
            ->orWhere("gender", "=", "Both")->where('block', '=', 0)->get();

        return response()->json([
            "data" => \App\Http\Resources\Nomination::collection($nominations)
        ], 200);
    }


    public function femaleNominations(Request $request)
    {
        $nominations = Nomination::where("gender", "=", "Female")
            ->orWhere("gender", "=", "Both")->where('block', '=', 0)->get();

        return response()->json([
            "data" => \App\Http\Resources\Nomination::collection($nominations)
        ], 200);
    }


    public function userSelectedNominations(Request $request)
    {
        $userSelectedNomination = UserNomination::where('user_id', '=', $request->user()->id)
            ->pluck("nominations_id");

        return response()->json([
            "data" => $userSelectedNomination
        ], 200);
    }
}
