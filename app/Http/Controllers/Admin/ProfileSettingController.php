<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileSettingController extends Controller
{
    public function index() {
        $user = Auth::guard("admin")->user();
        return view("admin.profile.profilesetting", compact("user"));
    }

    public function update(Request $request) {
        $this->validate($request, [
            'password' => 'nullable|string|min:8|confirmed'
        ]);

        $user = Auth::guard("admin")->user();
        $user->email = $request->email ?? $user->email;
        $user->phone_no = $request->phone_no ?? $user->phone_no;
        if ($request->password) {
            $user->password = bcrypt($request->password);
        }
        $user->save();

        return redirect()->route("admin.profileSetting.edit");
    }
}
