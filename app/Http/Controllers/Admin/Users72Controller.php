<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\Message;
use App\Models\Notification;
use App\Models\User;
use App\Models\User72;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class Users72Controller extends Controller
{
    public function index()
    {
        $users = User72::orderBy('id', 'DESC')->get();
        return view('admin.manageusers.users72.index', compact('users'));
    }

    public function add(Request $request)
    {
        $ids = $request->ids;
        $users = User::with('isUser72')->whereIn('id', explode(",", $ids))->get();
        foreach ($users as $user) {
            if ($user->isUser72 == null) {
                User72::create([
                    'user_id' => $user->id
                ]);

                Notification::create([
                    "user_id" => $user->id,
                    "message" => "You are now in Users of 72 group!"
                ]);

                $mailData = [
                    'subject' => 'Added to Users of 72 group!',
                    'title' => 'Congratulations!',
                    'body' => "Admin has added you to Users of 72 group.",
                ];

                Mail::to($user->email)->send(new Message($mailData));
            }
        }
        return response()->json(['success' => "Users add to User72 successfully."]);
    }

    public function addSingle($id)
    {
        $user = User::find($id);
        $user72Check = User72::where("user_id", "=", $user->id)->first();
        if ($user72Check == null) {
            User72::create([
                'user_id' => $user->id
            ]);

            Notification::create([
                "user_id" => $user->id,
                "message" => "You are now in Users of 72 group!"
            ]);

            $mailData = [
                'subject' => 'Added to Users of 72 group!',
                'title' => 'Congratulations!',
                'body' => "Admin has added you to Users of 72 group.",
            ];

            Mail::to($user->email)->send(new Message($mailData));
        } else {
            return  redirect()->back();
        }
        return redirect()->route('admin.manageUser.users72.list')->with("success", "Users add to User72 successfully.");
    }

    public function delete($id)
    {
        $user72 = User72::find($id);

        Notification::create([
            "user_id" => $user72->user_id,
            "message" => "You are removed from Users of 72 group!"
        ]);

        $mailData = [
            'subject' => 'Removed from Users of 72 group!',
            'title' => 'Removed!',
            'body' => "Admin has removed you from Users of 72 group.",
        ];

        Mail::to($user72->user->email)->send(new Message($mailData));

        $user72->delete();
        return redirect()->route('admin.manageUser.users72.list')
            ->with('success', 'User has been removed successfully!');
    }
}
