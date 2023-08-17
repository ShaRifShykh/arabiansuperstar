<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Notification;
use App\Models\User;
use App\Models\UserVote;
use Illuminate\Http\Request;

class VoteController extends Controller
{
    public function giveVote(Request $request, $id)
    {
        $user = User::find($id);
        $userVote = UserVote::where('user_id', '=', $user->id)->first();
        $userVote->votes_available += $request->votes;
        $userVote->save();

        Notification::create([
            "user_id" => $user->id,
            "message" => "Admin give you " . $request->votes . ' Votes.'
        ]);

        return redirect()->route("admin.manageUser.view", ["id" => $user->id]);
    }

    public function takeVote(Request $request, $id)
    {
        $user = User::find($id);
        $userVote = UserVote::where('user_id', '=', $user->id)->first();
        $userVote->votes_available -= $request->votes;
        $userVote->save();

        Notification::create([
            "user_id" => $user->id,
            "message" => "Admin has taken " . $request->votes . ' Votes.'
        ]);

        return redirect()->route("admin.manageUser.view", ["id" => $user->id]);
    }
}
