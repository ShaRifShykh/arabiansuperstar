<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AppSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SettingController extends Controller
{
    public function index()
    {
        $metaURL = AppSetting::where("key", "=", "meta_url")->first();
        $metaKeywords = AppSetting::where("key", "=", "meta_keywords")->first();
        $metaDescription = AppSetting::where("key", "=", "meta_description")->first();
        $instagram = AppSetting::where("key", "=", "instagram")->first();
        $twitter = AppSetting::where("key", "=", "twitter")->first();
        $youtube = AppSetting::where("key", "=", "youtube")->first();
        $snapchat = AppSetting::where("key", "=", "snapchat")->first();
        $pinterest = AppSetting::where("key", "=", "pinterest")->first();
        $linkedin = AppSetting::where("key", "=", "linkedin")->first();
        $facebook = AppSetting::where("key", "=", "facebook")->first();
        $google = AppSetting::where("key", "=", "google")->first();

        return view("admin.setting.index", compact('metaURL', 'metaKeywords', 'metaDescription', 'instagram', 'twitter', 'youtube', 'snapchat', 'pinterest', 'linkedin', 'facebook', 'google'));
    }

    public function update(Request $request)
    {
        DB::table("app_settings")->updateOrInsert(["key" => "meta_url"],
            ["value" => $request->meta_url]);

        DB::table("app_settings")->updateOrInsert(["key" => "meta_keywords"],
            ["value" => $request->meta_keywords]);

        DB::table("app_settings")->updateOrInsert(["key" => "meta_description"],
            ["value" => $request->meta_description]);

        DB::table("app_settings")->updateOrInsert(["key" => "instagram"],
            ["value" => $request->instagram]);

        DB::table("app_settings")->updateOrInsert(["key" => "twitter"],
            ["value" => $request->twitter]);

        DB::table("app_settings")->updateOrInsert(["key" => "youtube"],
            ["value" => $request->youtube]);

        DB::table("app_settings")->updateOrInsert(["key" => "snapchat"],
            ["value" => $request->snapchat]);

        DB::table("app_settings")->updateOrInsert(["key" => "pinterest"],
            ["value" => $request->pinterest]);

        DB::table("app_settings")->updateOrInsert(["key" => "linkedin"],
            ["value" => $request->linkedin]);

        DB::table("app_settings")->updateOrInsert(["key" => "facebook"],
            ["value" => $request->facebook]);

        DB::table("app_settings")->updateOrInsert(["key" => "google"],
            ["value" => $request->google]);

        return redirect()->route('admin.appSetting.index');
    }
}
