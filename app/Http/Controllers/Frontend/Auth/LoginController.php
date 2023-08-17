<?php

namespace App\Http\Controllers\Frontend\Auth;

use App\Http\Controllers\Controller;
use App\Models\Slider;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index()
    {
        if (Auth::guard("web")->check()) {
            return redirect()->route('home');
        }
        $sliders = Slider::where('key', '=', 'auth')->get();
        return view("frontend.auth.login", compact('sliders'));
    }

    public function login(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $user = User::where('email', '=', $request->email)->first();

        if ($user) {
            if ($user->block == 1) {
                return redirect()
                    ->route('loginView')
                    ->withErrors(['error' => 'You are blocked!']);
            }
        }

        if (auth("web")->attempt(array('email' => $request->email, 'password' => $request->password), true)) {
            return redirect()->route('home');
        } else {
            return redirect()
                ->route('loginView')
                ->withErrors(['error' => 'Incorrect email or password!']);
        }
    }
}
