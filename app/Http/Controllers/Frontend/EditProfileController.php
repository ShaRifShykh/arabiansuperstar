<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Mail\EmailVerificationMail;
use App\Models\Country;
use App\Models\Nomination;
use App\Models\ParticipatingCountry;
use App\Models\User;
use App\Models\UserGallery;
use App\Models\UserNomination;
use App\Models\UserUrl;
use App\Models\UserVideo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class EditProfileController extends Controller
{
    public function index()
    {
        $user = Auth::guard("web")->user();
        $countries = ParticipatingCountry::where("status", "=", 0)->get();
        $nationalities = Country::all();

        $maleNominations = Nomination::where("gender", "=", "Male")
            ->orWhere("gender", "=", "Both")->where('block', '=', 0)->get();
        $femaleNominations = Nomination::where("gender", "=", "Female")
            ->orWhere("gender", "=", "Both")->where('block', '=', 0)->get();

        $userSelectedNomination = UserNomination::where('user_id', '=', $user->id)->pluck("nominations_id");

        return view("frontend.editprofile.editprofile", compact("userSelectedNomination", "maleNominations", "femaleNominations", "user", "countries", "nationalities"));
    }

    public function editProfile(Request $request)
    {
        $user = Auth::guard("web")->user();

        if ($request->file("profile_photo")) {
            $this->validate($request, [
                'profile_photo' => 'required|image|max:5024|mimes:jpg,jpeg,png',
            ]);

            $file = $request->file("profile_photo");
            $path = $file->store('/public/users/profilePhoto', ['disks' => 'public']);
        }



        if ($request->email != $user->email) {
            $this->validate($request, [
                'email' => 'nullable|unique:users|email',
            ]);

            $verificationCode = rand(1000, 9999);
            $user->email_verified_at = null;
            $user->verification_code = $verificationCode;

            $mailData = [
                'title' => 'Verification code from Arabian Superstar',
                'body' => 'Here is the verification code: ' . $verificationCode,
            ];

            Mail::to($request->email)->send(new EmailVerificationMail($mailData));
        }

        if ($request->gender !== $user->gender) {
            $user->gender = $request->gender ?? $user->gender;
            $user->update();

            $user->nominations()->delete();
        } else {
            $user->gender = $request->gender ?? $user->gender;
            $user->update();
        }

        $userSelectedNomination = UserNomination::where('user_id', '=', $user->id)->pluck("nominations_id")->toArray();

        if ($user->gender === "Male") {
            foreach ($request->maleNominations as $nomination) {
                $nominationsToDelete = array_diff($userSelectedNomination, $request->maleNominations);

                foreach ($nominationsToDelete as $nominationToDelete) {
                    if ($nominationsToDelete != 1) {
                        UserNomination::where("user_id", "=", Auth::guard("web")->id())
                            ->where("nominations_id", "=", $nominationToDelete)->delete();
                    }
                }

                if (!collect($userSelectedNomination)->contains($nomination)) {
                    UserNomination::create([
                        "user_id" => $user->id,
                        "nominations_id" => $nomination
                    ]);
                }
            }
        } else {
            foreach ($request->femaleNominations as $nomination) {
                $nominationsToDelete = array_diff($userSelectedNomination, $request->maleNominations);

                foreach ($nominationsToDelete as $nominationToDelete) {
                    if ($nominationsToDelete != 1) {
                        UserNomination::where("user_id", "=", Auth::guard("web")->id())
                            ->where("nominations_id", "=", $nominationToDelete)->delete();
                    }
                }

                if (!collect($userSelectedNomination)->contains($nomination)) {
                    UserNomination::create([
                        "user_id" => $user->id,
                        "nominations_id" => $nomination
                    ]);
                }
            }
        }

        $user->profile_photo = $path ?? $user->profile_photo;
        $user->full_name = $request->full_name ?? $user->full_name;
        $user->username = $request->username ?? $user->username;
        $user->email = $request->email ?? $user->email;
        $user->phone_no = $request->phone_no ?? $user->phone_no;
        $user->country = $request->country ?? $user->country;
        $user->nationality = $request->nationality ?? $user->nationality;
        $user->date_of_birth = $request->date_of_birth ?? $user->date_of_birth;
        $user->zodiac = $request->zodiac ?? $user->zodiac;
        $user->hobbies = $request->hobbies ?? $user->hobbies;
        $user->bio = $request->bio ?? $user->bio;
        $user->update();

        return redirect('/edit_profile#profile');
    }

    // Image Crud
    public function insertImage(Request $request)
    {
        $path = $request->file('image')->store('/public/users/gallery', ['disks' => 'public']);

        $userGallery = new UserGallery();
        $userGallery->user_id = Auth::guard("web")->id();
        $userGallery->image = $path;
        $userGallery->description = $request->description;
        $userGallery->save();

//        return redirect()->route('editProfile');
        return redirect('/edit_profile#images');
    }

    public function updateImage(Request $request, $id)
    {
        if ($request->file('image')) {
            $path = $request->file('image')->store('/public/users/gallery', ['disks' => 'public']);
        }

        $userGallery = UserGallery::find($id);
        $userGallery->image = $path ?? $userGallery->image;
        $userGallery->description = $request->description ?? $userGallery->description;
        $userGallery->update();

        return redirect('/edit_profile#images');
    }

    public function deleteImage($id)
    {
        UserGallery::find($id)->delete();
        return redirect('/edit_profile#images');
    }


    // Video Crud
    public function insertVideo(Request $request)
    {
        $path = $request->file('video')->store('/public/users/videos', ['disks' => 'public']);

        $userVideo = new UserVideo();
        $userVideo->user_id = Auth::guard("web")->id();
        $userVideo->video = $path;
        $userVideo->description = $request->description;
        $userVideo->save();

        return redirect('/edit_profile#videos');
    }

    public function updateVideo(Request $request, $id)
    {
        if ($request->file('video')) {
            $path = $request->file('video')->store('/public/users/videos', ['disks' => 'public']);
        }

        $userVideo = UserVideo::find($id);
        $userVideo->video = $path ?? $userVideo->image;
        $userVideo->description = $request->description ?? $userVideo->description;
        $userVideo->update();

        return redirect('/edit_profile#videos');
    }

    public function deleteVideo($id)
    {
        UserVideo::find($id)->delete();
        return redirect('/edit_profile#videos');
    }


    // Url Crud
    public function insertUrl(Request $request)
    {
        $userUrl = new UserUrl();
        $userUrl->user_id = Auth::guard("web")->id();
        $userUrl->url = $request->url;
        $userUrl->save();

        return redirect('/edit_profile#urls');
    }

    public function updateUrl(Request $request, $id)
    {
        $userUrl = UserUrl::find($id);
        $userUrl->url = $request->url ?? $userUrl->url;
        $userUrl->update();

        return redirect('/edit_profile#urls');
    }

    public function deleteUrl($id)
    {
        UserUrl::find($id)->delete();
        return redirect('/edit_profile#urls');
    }


    // Change Password
    public function changePassword(Request $request)
    {
        $this->validate($request, [
            "current_password" => "required|string|min:8",
            "password" => "required|string|min:8|confirmed"
        ]);

        $user = Auth::guard("web")->user();

        if (Hash::check($request->current_password, $user->password)) {
            $user->password = bcrypt($request->pasword);
            return redirect('/edit_profile#changePassword');
        }

        return redirect('/edit_profile#changePassword');
//        return redirect()->route('editProfile')->with("error", "Password doesn't matched!");
    }
}
