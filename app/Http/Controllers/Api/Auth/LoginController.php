<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if ($validation->fails()) {
            return response()->json([
                'errors' => $validation->errors()
            ], 400);
        }

        $user = User::where('email', '=', $request->email)->first();

        if ($user) {
            if ($user->block == 1) {
                return response()->json([
                    'errors' => [
                        "error" => 'You are blocked!',
                    ]
                ], 400);
            }
        }

        if (auth()->attempt(array('email' => $request->email, 'password' => $request->password))) {
            $response = [
                "token" => $user->createToken('ArabianSuperstarUser')->plainTextToken,
                "data" => new \App\Http\Resources\User($user),
            ];

            return response()->json($response, 200);
        } else {
            return response()->json([
                'errors' => [
                    "error" => "Invalid Credentials!"
                ]
            ], 400);
        }
    }
}
