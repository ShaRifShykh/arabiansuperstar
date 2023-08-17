<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\UserNomination;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class EditProfileController extends Controller
{
    public function editProfile(Request $request)
    {
        $dt = new Carbon();
        $before = $dt->subYears(18)->format('Y-m-d');

        $validation = Validator::make($request->all(), [
            'date_of_birth' => 'nullable|date|before:' . $before,
        ], ['before' => 'You must be at least 18 years old']);

        if ($validation->fails()) {
            return response()->json([
                'errors' => $validation->errors()
            ], 400);
        }

        $user = User::find($request->user()->id);

        if ($request->file("profile_photo")) {
            $file = $request->file("profile_photo");
            $path = $file->store('/public/users/profilePhoto', ['disks' => 'public']);
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

        return response()->json([
            "data" => new \App\Http\Resources\User($user),
        ], 200);
    }


    public function updateGender(Request $request)
    {
        $user = User::find($request->user()->id);


        if ($request->gender !== $user->gender) {
            $user->gender = $request->gender ?? $user->gender;
            $user->update();

            $user->nominations()->delete();
        } else {
            $user->gender = $request->gender ?? $user->gender;
            $user->update();
        }

        $userSelectedNomination = UserNomination::where('user_id', '=', $user->id)->pluck("nominations_id")->toArray();


        foreach ($request->nominations as $nomination) {
            $nominationsToDelete = array_diff($userSelectedNomination, $request->nominations);

            foreach ($nominationsToDelete as $nominationToDelete) {
                if ($nominationsToDelete != 1) {
                    UserNomination::where("user_id", "=", $request->user()->id)
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

        return response()->json([
            "data" => new \App\Http\Resources\User($user),
        ], 200);
    }
}
