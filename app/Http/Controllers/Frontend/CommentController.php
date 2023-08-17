<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Action;
use App\Models\Comment;
use App\Models\Notification;
use App\Models\Slider;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function index($username)
    {
        $user = User::with("comments")
            ->where("username", "=", $username)->first();
        $action = Action::where('action', '=', 'comment')->first();
        $leftSliders = Slider::where('key', '=', 'comment_left')->get();
        $rightSliders = Slider::where('key', '=', 'comment_right')->get();

        return view("frontend.comments", compact("user", "action", "leftSliders", "rightSliders"));
    }

    public function add(Request $request, $to)
    {
        $comment = new Comment();
        $comment->to = $to;
        $comment->by = Auth::guard("web")->user()->id;
        $comment->comment = $request->comment;
        $comment->save();

        $notification = new Notification();
        $notification->user_id = $to;
        $notification->comment_id = $comment->id;
        $notification->save();

        return redirect()->back();
    }
}
