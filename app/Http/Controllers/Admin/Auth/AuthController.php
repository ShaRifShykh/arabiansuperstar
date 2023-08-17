<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function signInView()
    {
        if (Auth::guard("admin")->check()) {
            return redirect()->route("admin.dashboard");
        }
        return view("admin.auth.login");
    }

    public function signIn(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (auth("admin")->attempt(array('email' => $request->email, 'password' => $request->password))) {
            return redirect()->route('admin.dashboard');
        } else {
            return redirect()
                ->route('admin.auth.signInView')
                ->withErrors(['error' => 'Incorrect email or password!']);
        }
    }

    public function logout(Request $request)
    {
        Auth::guard("admin")->logout();
        return redirect()->route("admin.auth.signInView");
    }
}
