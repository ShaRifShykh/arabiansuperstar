<?php

namespace App\Http\Controllers\Frontend\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\UserAction;
use App\Models\UserVote;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class GoogleAuthController extends Controller
{
    public function redirect()
    {
        return Socialite::driver('google')->redirect();
    }

    public function callBackGoogle()
    {
        try {
            $google_user = Socialite::driver('google')->user();
            $user = User::where('google_id', $google_user->getId())->first();

            if (!$user) {
                $new_user = User::create([
                    'full_name' => $google_user->getName(),
                    'username' => $google_user->getEmail(),
                    'email' => $google_user->getEmail(),
                    'google_id' => $google_user->getId(),
                    'email_verified_at' => Carbon::now()->toDateTimeString(),
                ]);

                UserVote::create([
                    "user_id" => $new_user->id,
                    "votes_available" => 50,
                ]);

                UserAction::create([
                    "user_id" => $new_user->id,
                    "commenting" => 0,
                    "liking" => 0,
                    "voting" => 0,
                    "rating" => 0,
                ]);

                Auth::login($new_user);

                return redirect()->route('addPersonalDetailView');
            } else {
                if ($user->block == 1) {
                    return redirect()
                        ->route('loginView')
                        ->withErrors(['error' => 'You are blocked!']);
                }

                Auth::login($user);

                return redirect()->route('home');
            }
        } catch (\Throwable $th) {
            // Show Error
        }
    }
}
