<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\UserUrl;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UrlController extends Controller
{
    public function create(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'url' => "required|string",
        ]);

        if ($validation->fails()) {
            $response = [
                'errors' => $validation->errors()
            ];

            return response()->json($response, 400);
        }

        $userUrl = new UserUrl();
        $userUrl->user_id = $request->user()->id;
        $userUrl->url = $request->url;
        $userUrl->save();

        $user = User::find($request->user()->id);

        return response()->json([
            "data" => new \App\Http\Resources\User($user),
        ], 200);
    }


    public function delete(Request $request, $id)
    {
        UserUrl::find($id)->delete();
        $user = User::find($request->user()->id);

        return response()->json([
            "data" => new \App\Http\Resources\User($user),
        ], 200);
    }
}
