<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Mail\EmailVerificationMail;
use App\Models\Action;
use App\Models\User;
use App\Models\UserAction;
use App\Models\UserNomination;
use App\Models\UserVote;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class SignUpController extends Controller
{
    public function signUp(Request $request)
    {
        $action = Action::where('action', '=', 'registration')->first();

        if ($action->block == 1) {
            return response()->json([
                "errors" => [
                    "error" => "Registration are blocked right now!"
                ]
            ], 400);
        }

        $validation = Validator::make($request->all(), [
            'full_name' => 'required|string',
            'username' => 'required|string|unique:users',
            'email' => 'required|email|unique:users',
            'phone_no' => 'required',
            'password' => 'required|between:8,255|confirmed',
        ]);

        if ($validation->fails()) {
            return response()->json([
                'errors' => $validation->errors()
            ], 400);
        }

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

        if (auth()->attempt(array('email' => $request->email, 'password' => $request->password))) {
            $mailData = [
                'title' => 'Verification code from Arabian Superstar',
                'body' => 'Here is the verification code: ' . $verificationCode,
            ];

            Mail::to($request->email)->send(new EmailVerificationMail($mailData));

            $response = [
                "token" => $user->createToken('ArabianSuperstarUser')->plainTextToken,
                "data" => new \App\Http\Resources\User($user)
            ];

            return response()->json($response, 200);
        } else {
            return response()->json([
                'errors' => [
                    "error" => "Server Error!"
                ]
            ], 400);
        }
    }


    public function addPersonalDetail(Request $request)
    {
        $dt = new Carbon();
        $before = $dt->subYears(18)->format('Y-m-d');

        $validation = Validator::make($request->all(), [
            'country' => 'required|string',
            'nationality' => 'required|string',
            'gender' => 'required|string',
            'date_of_birth' => 'required|date|before:' . $before,
        ], ['before' => 'You must be at least 18 years old']);

        if ($validation->fails()) {
            $response = [
                'errors' => $validation->errors()
            ];

            return response()->json($response, 400);
        }

        $user = $request->user();
        $user->country = $request->country;
        $user->nationality = $request->nationality;
        $user->gender = $request->gender;
        $user->date_of_birth = $request->date_of_birth;
        $user->zodiac = $request->zodiac;
        $user->save();

        $response = [
            'data' => new \App\Http\Resources\User($user)
        ];

        return response()->json($response, 200);
    }


    public function addPersonalityDetail(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'hobbies' => 'required',
            'nominations' => 'required|array',
        ]);

        if ($validation->fails()) {
            $response = [
                'errors' => $validation->errors()
            ];

            return response()->json($response, 400);
        }

        $user = $request->user();
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

        $response = [
            'data' => new \App\Http\Resources\User($user)
        ];

        return response()->json($response, 200);
    }


    public function addBio(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'bio' => 'required',
        ]);

        if ($validation->fails()) {
            $response = [
                'errors' => $validation->errors()
            ];

            return response()->json($response, 400);
        }


        $user = User::find($request->user()->id);

        if ($user->galleries()->count() < 1) {
            return response()->json([
                "errors" => [
                    "error" => "Upload at least 1 gallery!",
                ]
            ], 400);
        }

        if ($user->videos()->count() < 1) {
            return response()->json([
                "errors" => [
                    "error" => "Upload at least 1 video!",
                ]
            ], 400);
        }

        $user->bio = $request->bio;
        $user->save();

        // Photos And Videos Create

        $response = [
            'data' => new \App\Http\Resources\User($user)
        ];

        return response()->json($response, 200);
    }


    public function addProfilePhoto(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'profile_photo' => 'required|image|max:5024|mimes:jpg,jpeg,png',
        ]);

        if ($validation->fails()) {
            $response = [
                'errors' => $validation->errors()
            ];

            return response()->json($response, 400);
        }

        $file = $request->file("profile_photo");
        $path = $file->store('/public/users/profilePhoto', ['disks' => 'public']);

        $user = $request->user();
        $user->profile_photo = $path;
        $user->save();

        $response = [
            'data' => new \App\Http\Resources\User($user)
        ];

        return response()->json($response, 200);
    }
}
