<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Mail\EmailVerificationMail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Mail;

class EmailVerificationController extends Controller
{
    public function verifyEmail(Request $request)
    {
        $user = User::find($request->user()->id);

        if ($user->verification_code === $request->code) {
            $user->email_verified_at = Carbon::now()->toDateTimeString();
            $user->update();

            return response()->json([
                "data" => new \App\Http\Resources\User($user)
            ], 200);
        }

        return response()->json([
            "errors" => [
                "error" => 'Invalid Verification Code!',
            ]
        ], 400);
    }

    public function resendVerificationCode(Request $request)
    {
        $user = User::find($request->user()->id);
        $verificationCode = rand(1000, 9999);
        $user->verification_code = $verificationCode;
        $user->update();

        $mailData = [
            'title' => 'Verification code from Arabian Superstar',
            'body' => 'Here is the verification code: ' . $verificationCode,
        ];

        Mail::to($user->email)->send(new EmailVerificationMail($mailData));

        return response()->json([
            "message" => "Code resend successfully!"
        ], 200);
    }
}
