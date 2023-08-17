<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\Message;
use App\Models\Notification;
use App\Models\User;
use App\Models\User360;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class Users360Controller extends Controller
{
    public function index()
    {
        $users = User360::orderBy('id', 'DESC')->get();
        return view('admin.manageusers.users360.index', compact('users'));
    }

    public function add(Request $request)
    {
        $ids = $request->ids;
        $users = User::with('isUser360')->whereIn('id', explode(",", $ids))->get();
        foreach ($users as $user) {
            if ($user->isUser360 == null) {
                User360::create([
                    'user_id' => $user->id
                ]);

                Notification::create([
                    "user_id" => $user->id,
                    "message" => "You are now in Users of 360 group!"
                ]);

                $mailData = [
                    'subject' => 'Added to Users of 360 group!',
                    'title' => 'Congratulations!',
                    'body' => "Admin has added you to Users of 360 group.",
                ];

                Mail::to($user->email)->send(new Message($mailData));
            }
        }
        return response()->json(['success' => "Users add to User360 successfully."]);
    }

    public function addSingle($id)
    {
        $user = User::find($id);
        $user360Check = User360::where("user_id", "=", $user->id)->first();
        if ($user360Check == null) {
            User360::create([
                'user_id' => $user->id
            ]);

            Notification::create([
                "user_id" => $user->id,
                "message" => "You are now in Users of 360 group!"
            ]);

            $mailData = [
                'subject' => 'Added to Users of 360 group!',
                'title' => 'Congratulations!',
                'body' => "Admin has added you to Users of 360 group.",
            ];

            Mail::to($user->email)->send(new Message($mailData));
        } else {
            return  redirect()->back();
        }
        return redirect()->route('admin.manageUser.users360.list')->with("success", "Users add to User360 successfully.");
    }

    public function delete($id)
    {
        $user360 = User360::find($id);

        Notification::create([
            "user_id" => $user360->user_id,
            "message" => "You are removed from Users of 360 group!"
        ]);

        $mailData = [
            'subject' => 'Removed from Users of 360 group!',
            'title' => 'Removed!',
            'body' => "Admin has removed you from Users of 360 group.",
        ];

        Mail::to($user360->user->email)->send(new Message($mailData));

        $user360->delete();

        return redirect()->route('admin.manageUser.users360.list')
            ->with('success', 'User has been removed successfully!');
    }
}
