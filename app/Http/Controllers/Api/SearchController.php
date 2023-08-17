<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Nomination;
use App\Models\User;
use App\Models\UserNomination;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function search(Request $request)
    {
        $q = $request->search;

        if ($request->filter != null || $request->country != null || $request->gender != null) {
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
            $searchUsers = User::where("email_verified_at", "!=", null)
                ->where('full_name', 'LIKE', '%' . $q . '%')
                ->where('username', 'LIKE', '%' . $q . '%')
                ->get()->except($request->user()->id);
        }

        return response()->json([
            "data" => \App\Http\Resources\User::collection($searchUsers)
        ], 200);
    }
}
