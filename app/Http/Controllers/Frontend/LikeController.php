<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Like;
use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LikeController extends Controller
{
    public function add($to)
    {
        $like = new Like();
        $like->to = $to;
        $like->by = Auth::guard("web")->user()->id;
        $like->save();

        $notification = new Notification();
        $notification->user_id = $to;
        $notification->like_id = $like->id;
        $notification->save();

        return redirect()->back();
    }
}
