<?php

namespace App\Http\Controllers\Frontend\Auth;

use App\Http\Controllers\Controller;
use App\Mail\EmailVerificationMail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class EmailVerificationController extends Controller
{
    public function verifyEmail(Request $request)
    {
        $user = User::find(Auth::guard("web")->id());

        if ($user->verification_code === $request->code) {
            $user->email_verified_at = Carbon::now()->toDateTimeString();
            $user->update();

            return redirect()->route('home');
        }

        return redirect()->route("verification.code")->with('error', 'Invalid Verification Code!');
    }

    public function resendVerificationCode()
    {
        $user = User::find(Auth::guard("web")->id());
        $verificationCode = rand(1000, 9999);
        $user->verification_code = $verificationCode;
        $user->update();

        $mailData = [
            'title' => 'Verification code from Arabian Superstar',
            'body' => 'Here is the verification code: ' . $verificationCode,
        ];

        Mail::to($user->email)->send(new EmailVerificationMail($mailData));

        return redirect()->route("verification.code")->with('success', 'Verification code send successfully!');
    }
}
