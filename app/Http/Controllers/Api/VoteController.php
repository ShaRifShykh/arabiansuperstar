<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Notification;
use App\Models\User;
use App\Models\UserVote;
use Illuminate\Http\Request;

class VoteController extends Controller
{
    public function sendVote(Request $request, $to)
    {
        $userToSendVote = UserVote::where("user_id", "=", $to)->first();
        $myVotes = UserVote::find($request->user()->availableVote->id);

        if ($myVotes->votes_available > 0) {
            $userToSendVote->total_voting += 1;
            $userToSendVote->update();

            $myVotes->votes_available -= 1;
            $myVotes->update();

            if ($request->user()->id != $to) {
                Notification::create([
                    "user_id" => $to,
                    "message" => "You have received a vote from " . $request->user()->username,
                ]);
            }

            $userData = User::find($to);
            $user = User::find($request->user()->id);

            return response()->json([
                "message" => "Vote Successfully!",
                "userData" => new \App\Http\Resources\User($userData),
                "data" => new \App\Http\Resources\User($user)
            ], 200);
        }

        return response([
            "errors" => "Not enough votes available!"
        ], 400);
    }
}
