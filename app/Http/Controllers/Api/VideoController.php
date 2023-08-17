<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\UserVideo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class VideoController extends Controller
{
    public function create(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'video' => 'required|max:100000|mimes:mp4,mov,ogg',
        ]);

        if ($validation->fails()) {
            $response = [
                'errors' => $validation->errors()
            ];

            return response()->json($response, 400);
        }

        $path = $request->file('video')->store('/public/users/videos', ['disks' => 'public']);

        $userVideo = new UserVideo();
        $userVideo->user_id = $request->user()->id;
        $userVideo->video = $path;
        $userVideo->description = $request->description;
        $userVideo->save();

        $user = User::find($request->user()->id);

        return response()->json([
            "data" => new \App\Http\Resources\User($user),
        ], 200);
    }


    public function update(Request $request, $id)
    {
        if ($request->file('video')) {
            $path = $request->file('video')->store('/public/users/videos', ['disks' => 'public']);
        }

        $userVideo = UserVideo::find($id);
        $userVideo->video = $path ?? $userVideo->image;
        $userVideo->description = $request->description ?? $userVideo->description;
        $userVideo->update();

        $user = User::find($request->user()->id);

        return response()->json([
            "data" => new \App\Http\Resources\User($user),
        ], 200);
    }


    public function delete(Request $request, $id)
    {
        UserVideo::find($id)->delete();

        $user = User::find($request->user()->id);

        return response()->json([
            "data" => new \App\Http\Resources\User($user),
        ], 200);
    }
}
