<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function user(Request $request)
    {
        $user = User::find($request->user()->id);

        return response()->json([
            'data' => new \App\Http\Resources\User($user),
        ], 200);
    }
}
