<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LogoutController extends Controller
{
    public function logout(Request $request)
    {
        $request->user("api")->currentAccessToken()->delete();
        return response()->json(['message' => 'User Logged Out!'], 200);
    }
}
