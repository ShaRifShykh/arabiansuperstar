<?php

namespace App\Http\Controllers\Frontend\Auth;

use App\Http\Controllers\Controller;
use App\Mail\EmailVerificationMail;
use App\Models\Action;
use App\Models\Country;
use App\Models\Nomination;
use App\Models\ParticipatingCountry;
use App\Models\Slider;
use App\Models\User;
use App\Models\UserAction;
use App\Models\UserGallery;
use App\Models\UserNomination;
use App\Models\UserUrl;
use App\Models\UserVideo;
use App\Models\UserVote;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class SignUpController extends Controller
{
    public function index()
    {
        if (Auth::guard("web")->check()) {
            return redirect()->route('home');
        }

        $sliders = Slider::where('key', '=', 'auth')->get();

        return view("frontend.auth.signUp", compact('sliders'));
    }

    public function addPersonalDetailView()
    {
        $user = Auth::guard("web")->user();
        $countries = ParticipatingCountry::where("status", "=", 0)->get();
        $nationalities = Country::all();

        return view("frontend.auth.personal", compact("countries", "nationalities", "user"));
    }

    public function addPersonalityView()
    {
        $user = Auth::guard("web")->user();
        $nominations = Nomination::where("gender", "=", $user->gender)
            ->orWhere("gender", "=", "Both")->where('block', '=', 0)->get();
        $userSelectedNomination = UserNomination::where('user_id', '=', $user->id)->pluck("nominations_id");

        return view("frontend.auth.personality", compact("nominations", "user", "userSelectedNomination"));
    }

    public function addBioView()
    {
        $user = Auth::guard("web")->user();
        return view("frontend.auth.bio", compact("user"));
    }

    public function addProfilePhotoView()
    {
        $user = Auth::guard("web")->user();
        return view("frontend.auth.profilePhoto", compact("user"));
    }

    public function signUp(Request $request)
    {
        $action = Action::where('action', '=', 'registration')->first();

        if ($action->block == 1) {
            return redirect()->route('signUp')
                ->withErrors(['error' => 'Registration are blocked right now!']);
        }

        $this->validate($request, [
            'full_name' => 'required|string',
            'username' => 'required|string|unique:users',
            'email' => 'required|email|unique:users',
            'phone_no' => 'required',
            'password' => 'required|between:8,255|confirmed',
        ]);

        $verificationCode = rand(1000, 9999);

        $user = new User();
        $user->full_name = $request->full_name;
        $user->username = $request->username;
        $user->email = $request->email;
        $user->phone_no = $request->phone_no;
        $user->password = bcrypt($request->password);
        $user->verification_code = $verificationCode;
        $user->save();

        UserVote::create([
            "user_id" => $user->id,
            "votes_available" => 50,
            "total_voting" => 0,
        ]);

        UserAction::create([
            "user_id" => $user->id,
            "commenting" => 0,
            "liking" => 0,
            "voting" => 0,
            "rating" => 0,
        ]);

        if (auth("web")->attempt(array('email' => $request->email, 'password' => $request->password), true)) {
            $mailData = [
                'title' => 'Verification code from Arabian Superstar',
                'body' => 'Here is the verification code: ' . $verificationCode,
            ];

            Mail::to($request->email)->send(new EmailVerificationMail($mailData));
            return redirect()->route('verification.code');
        } else {
            return redirect()->route('signUp');
        }
    }

    public function addPersonalDetail(Request $request)
    {
        $dt = new Carbon();
        $before = $dt->subYears(18)->format('Y-m-d');

        $this->validate($request, [
            'country' => 'required|string',
            'nationality' => 'required|string',
            'gender' => 'required|string',
            'date_of_birth' => 'required|date|before:' . $before,
        ], ['before' => 'You must be at least 18 years old']);

        $user = $request->user("web");
        $user->country = $request->country;
        $user->nationality = $request->nationality;
        $user->gender = $request->gender;
        $user->date_of_birth = $request->date_of_birth;
        $user->zodiac = $request->zodiac;
        $user->save();

        return redirect()->route("addPersonalityView");
    }

    public function addPersonality(Request $request)
    {
        $this->validate($request, [
            'hobbies' => 'required',
            'nominations' => 'required|array',
        ]);

        $user = $request->user("web");
        $user->hobbies = $request->hobbies;
        $user->save();

        $userSelectedNomination = UserNomination::where('user_id', '=', $user->id)->pluck("nominations_id");

        foreach ($request->nominations as $nomination) {
            if (!collect($userSelectedNomination)->contains($nomination)) {
                UserNomination::create([
                    "user_id" => $user->id,
                    "nominations_id" => $nomination
                ]);
            }
        }

        return redirect()->route("addBioView");
    }

    public function addBio(Request $request)
    {
        $this->validate($request, [
            'bio' => 'required',
        ]);

        $user = $request->user('web');
        $user->bio = $request->bio;
        $user->save();


        // Images Upload
        if ($request->file('photos') != null) {
            foreach ($request->file("photos") as $key => $photo) {
                $imagePath = $photo->store('/public/users/gallery', ['disks' => 'public']);

                UserGallery::create([
                    "user_id" => $user->id,
                    "image" => $imagePath,
                    "description" => $request->photos_description[$key],
                ]);
            }
        }

        if ($request->uploadedPhotosID != null) {
            foreach ($request->uploadedPhotosID as $imgID) {
                if ($request->file('uploadedPhotos[' . $imgID . ']')) {
                    $uploadedImagePath = $request->file('uploadedPhotos[' . $imgID . ']')->store('/public/users/gallery', ['disks' => 'public']);
                }
                $userGallery = UserGallery::find($imgID);
                $userGallery->image = $uploadedImagePath ?? $userGallery->image;
                $userGallery->description = $request->uploadedPhotosDescription[$imgID] ?? $userGallery->description;
                $userGallery->update();
            }
        }


        // Videos Upload
        if ($request->file('video') != null) {
            foreach ($request->file("video") as $key => $video) {
                $videoPath = $video->store('/public/users/videos', ['disks' => 'public']);

                UserVideo::create([
                    "user_id" => $user->id,
                    "video" => $videoPath,
                    "description" => $request->videoDescription[$key],
                ]);
            }
        }

        if ($request->uploadedVideosID != null) {
            foreach ($request->uploadedVideosID as $videoID) {
                if ($request->file('uploadedVideo[' . $videoID . ']')) {
                    $uploadedVideoPath = $request->file('uploadedVideo[' . $videoID . ']')->store('/public/users/videos', ['disks' => 'public']);
                }
                $userVideo = UserVideo::find($videoID);
                $userVideo->video = $uploadedVideoPath ?? $userVideo->video;
                $userVideo->description = $request->uploadedVideoDescription[$videoID] ?? $userVideo->description;
                $userVideo->update();
            }
        }


        // URL Add
        foreach ($request->url as $key => $url) {
            if ($url != null) {
                UserUrl::create([
                    "user_id" => $user->id,
                    "url" => $url,
                ]);
            }
        }

        if ($request->uploadedUrlIDs != null) {
            foreach ($request->uploadedUrlIDs as $urlID) {
                $userUrl = UserUrl::find($urlID);
                $userUrl->url = $request->uploadedUrl[$urlID] ?? $userUrl->url;
                $userUrl->update();
            }
        }

        return redirect()->route("addProfilePhotoView");
    }

    public function addProfilePhoto(Request $request)
    {
        $user = $request->user("web");

        if ($user->profile_photo == null) {
            $this->validate($request, [
                'profile_photo' => 'required|image|max:5024|mimes:jpg,jpeg,png',
            ]);

            $file = $request->file("profile_photo");
            $path = $file->store('/public/users/profilePhoto', ['disks' => 'public']);
        }

        $user->profile_photo = $user->profile_photo ?? $path;
        $user->save();

        return redirect()->route("home");
    }

    // Delete Stuff
    public function deleteUrl($id)
    {
        UserUrl::find($id)->delete();

        return response()->json([
            'success' => true,
            'message' => 'Your data was deleted successfully!'
        ], 200);
    }

    public function deleteVideo($id)
    {
        UserVideo::find($id)->delete();

        return response()->json([
            'success' => true,
            'message' => 'Your data was deleted successfully!'
        ], 200);
    }

    public function deleteImg($id)
    {
        UserGallery::find($id)->delete();

        return response()->json([
            'success' => true,
            'message' => 'Your data was deleted successfully!'
        ], 200);
    }
}
