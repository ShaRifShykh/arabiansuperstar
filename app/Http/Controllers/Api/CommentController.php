<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Logic\PushNotification;
use App\Models\Action;
use App\Models\Comment;
use App\Models\Notification;
use App\Models\User;
use App\Models\UserAction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CommentController extends Controller
{
    public function index(Request $request, $id)
    {
        $comments = Comment::where("to", "=", $id)
            ->where('block', '=', 0)->orderBy('id', 'DESC')->get();
        $isCommentingBlock = Action::where('action', '=', 'comment')->first()->block;
        $isUserCommentingBlock = UserAction::where("user_id", "=", $request->user()->id)->first()->commenting;

        return response([
            "isCommentingBlock" => $isCommentingBlock,
            "isUserCommentingBlock" => $isUserCommentingBlock,
            "data" => \App\Http\Resources\Comment::collection($comments),
        ], 200);
    }


    public function insert(Request $request, $to)
    {
        $validation = Validator::make($request->all(), [
            'comment' => 'required',
        ]);

        if ($validation->fails()) {
            $response = [
                'errors' => $validation->errors()
            ];

            return response()->json($response, 400);
        }

        $comment = new Comment();
        $comment->to = $to;
        $comment->by = $request->user()->id;
        $comment->comment = $request->comment;
        $comment->save();

        $notification = new Notification();
        $notification->user_id = $to;
        $notification->comment_id = $comment->id;
        $notification->save();

        $user = User::find($to);

        $pushNotification = new PushNotification();
        $pushNotification->sendToSelect([
            $user->device_token,
        ], "Someone commented on your profile!", $request->user()->full_name . " commented on your profile.");

        $comments = Comment::where("to", "=", $to)
            ->where('block', '=', 0)->orderBy('id', 'DESC')->get();

        $user = User::find($to);

        return response([
            "data" => \App\Http\Resources\Comment::collection($comments),
            "user" => new \App\Http\Resources\User($user)
        ], 200);
    }
}
