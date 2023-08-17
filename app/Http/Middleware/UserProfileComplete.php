<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class UserProfileComplete
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $user = auth("web")->user();

        if (!auth("web")->check()) {
            return $next($request);
        } elseif ($user->country == null || $user->gender == null || $user->date_of_birth == null) {
            return redirect()->route('addPersonalDetailView');
        } elseif ($user->hobbies == null) {
            return redirect()->route('addPersonalityView');
        } elseif ($user->bio == null) {
            return redirect()->route('addBioView');
        } elseif ($user->profile_photo == null) {
            return redirect()->route('addProfilePhotoView');
        }

        return $next($request);
    }
}
