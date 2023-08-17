<?php

namespace App\Http\Controllers\Frontend\Auth;

use App\Http\Controllers\Controller;
use App\Mail\EmailVerificationMail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ResetPasswordController extends Controller
{
    public function sendEmailView()
    {
        return view("frontend.auth.sendemail");
    }

    public function sendCodeView($id)
    {
        $user = User::find($id);
        return view("frontend.auth.sendcode", compact("user"));
    }

    public function sendResetPasswordMail(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email',
        ]);

        $user = User::where("email", "=", $request->email)->first();

        if (!$user) {
            return redirect()->route("resetPassword")->with('error', "Email doesn't exists!");
        }

        $verificationCode = rand(1000, 9999);
        $user->verification_code = $verificationCode;
        $user->update();

        $mailData = [
            'title' => 'Verification code from Arabian Superstar',
            'body' => 'Here is the verification code: ' . $verificationCode,
        ];

        Mail::to($user->email)->send(new EmailVerificationMail($mailData));

        return redirect()->route("resetPasswordCode", ["id" => $user->id]);
    }

    public function verifyCode(Request $request, $id)
    {
        $user = User::find($id);

        if ($user->verification_code === $request->code) {

            return view("frontend.auth.resetpassword", compact("user"));
        }

        return redirect()->route("resetPasswordCode", ["id" => $user->id])->with('error', 'Invalid Verification Code!');
    }

    public function newPassword(Request $request)
    {
        $user = User::find($request->id);
        if ($request->password != $request->password_confirmation) {
            return view("frontend.auth.resetpassword", compact("user"))->with("error", "Password doesn't match!");
        }

        $user->password = bcrypt($request->password);
        $user->save();

        return redirect()->route("loginView");
    }
}
