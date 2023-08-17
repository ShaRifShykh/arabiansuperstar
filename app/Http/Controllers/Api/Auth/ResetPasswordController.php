<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Mail\EmailVerificationMail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class ResetPasswordController extends Controller
{
    public function sendResetPasswordMail(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'email' => 'required|email',
        ]);

        if ($validation->fails()) {
            return response()->json([
                'errors' => $validation->errors()
            ], 400);
        }

        $user = User::where("email", "=", $request->email)->first();

        if (!$user) {
            return response()->json([
                'errors' => "Email doesn't Exist!"
            ], 400);
        }

        $verificationCode = rand(1000, 9999);
        $user->verification_code = $verificationCode;
        $user->update();

        $mailData = [
            'title' => 'Verification code from Arabian Superstar',
            'body' => 'Here is the verification code: ' . $verificationCode,
        ];

        Mail::to($user->email)->send(new EmailVerificationMail($mailData));

        return response([
            "data" => new User($user),
        ], 200);
    }


    public function verifyCode(Request $request)
    {
        $user = User::find($request->user_id);

        if ($user->verification_code === $request->code) {
            return response()->json([
                "data" => $user
            ], 400);
        }

        return response()->json([
            'errors' => "Invalid Code!"
        ], 400);
    }


    public function newPassword(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'password' => 'required|string|min:8|confirmed',
        ]);

        if ($validation->fails()) {
            return response()->json([
                'errors' => $validation->errors()
            ], 400);
        }

        $user = User::find($request->user_id);
        $user->password = bcrypt($request->password);
        $user->save();

        return response([
            "message" => "Password Changed Successfully!",
        ], 200);
    }
}
