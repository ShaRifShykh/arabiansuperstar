<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\UserGallery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class GalleryController extends Controller
{
    public function create(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'image' => 'required|image|max:5024|mimes:jpg,jpeg,png',
        ]);

        if ($validation->fails()) {
            $response = [
                'errors' => $validation->errors()
            ];

            return response()->json($response, 400);
        }

        $path = $request->file('image')->store('/public/users/gallery', ['disks' => 'public']);

        $userGallery = new UserGallery();
        $userGallery->user_id = $request->user()->id;
        $userGallery->image = $path;
        $userGallery->description = $request->description;
        $userGallery->save();

        $user = User::find($request->user()->id);

        return response()->json([
            "data" => new \App\Http\Resources\User($user),
        ], 200);
    }


    public function update(Request $request, $id)
    {
        if ($request->file('image')) {
            $path = $request->file('image')->store('/public/users/gallery', ['disks' => 'public']);
        }

        $userGallery = UserGallery::find($id);
        $userGallery->image = $path ?? $userGallery->image;
        $userGallery->description = $request->description ?? $userGallery->description;
        $userGallery->update();

        $user = User::find($request->user()->id);

        return response()->json([
            "data" => new \App\Http\Resources\User($user),
        ], 200);
    }


    public function delete(Request $request, $id)
    {
        UserGallery::find($id)->delete();

        $user = User::find($request->user()->id);

        return response()->json([
            "data" => new \App\Http\Resources\User($user),
        ], 200);
    }
}
