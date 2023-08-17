<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Country;
use App\Models\Nomination;
use App\Models\Notification;
use App\Models\Rating;
use App\Models\User;
use App\Models\UserAction;
use App\Models\UserGallery;
use App\Models\UserNomination;
use App\Models\UserUrl;
use App\Models\UserVideo;
use Illuminate\Http\Request;
use Rap2hpoutre\FastExcel\FastExcel;

class ManageUserController extends Controller
{
    private function getRatings($user)
    {
        $rating = 0;

        if ($user) {
            $oneRating = Rating::where("to", "=", $user->id)->where("rating", "=", 1)->get();
            $twoRating = Rating::where("to", "=", $user->id)->where("rating", "=", 2)->get();
            $threeRating = Rating::where("to", "=", $user->id)->where("rating", "=", 3)->get();
            $fourRating = Rating::where("to", "=", $user->id)->where("rating", "=", 4)->get();
            $fiveRating = Rating::where("to", "=", $user->id)->where("rating", "=", 5)->get();
            $totalRating = Rating::where("to", "=", $user->id)->get();

            if ($totalRating->count() != 0) {
                // Average Rating (AR) = 1*a+2*b+3*c+4*d+5*e/(R)
                // a = Total 1 Star Ratings, b = Total 2 Star Ratings, c = Total 3 Star Ratings, d = Total 4 Star Ratings, e = Total 5 Star Ratings,
                $rating = ((1 * $oneRating->count()) + (2 * $twoRating->count()) + (3 * $threeRating->count()) + (4 * $fourRating->count()) + (5 * $fiveRating->count())) / $totalRating->count();
            }
        }

        return $rating;
    }

    public function index(Request $request)
    {
        if ($request->gender == "Male") {
            $users = User::orderby('id', 'desc')->where("email_verified_at", "!=", null)
                ->where('gender', '=', 'Male')->get();
        } elseif ($request->gender == "Female") {
            $users = User::orderby('id', 'desc')->where("email_verified_at", "!=", null)
                ->where('gender', '=', 'Female')->get();
        } else {
            $users = User::orderby('id', 'desc')->
            where("email_verified_at", "!=", null)->get();
        }
        return view('admin.manageusers.index', compact('users'));
    }

    public function view($id)
    {
        $user = User::find($id);
        $phoneCode = Country::where('name', '=', $user->country)->first();
        $rating = $this->getRatings($user);
        $notifications = Notification::with("comment", "like", "rating", "voteBy")
            ->orderBy('id', 'DESC')
            ->where("user_id", "=", $user->id)->get();
        return view('admin.manageusers.view', compact('user', 'phoneCode', 'rating', 'notifications'));
    }

    public function edit($id)
    {
        $user = User::find($id);
        $countries = Country::all();

        $maleNominations = Nomination::where("gender", "=", "Male")
            ->orWhere("gender", "=", "Both")->where('block', '=', 0)->get();
        $femaleNominations = Nomination::where("gender", "=", "Female")
            ->orWhere("gender", "=", "Both")->where('block', '=', 0)->get();

        $userSelectedNomination = UserNomination::where('user_id', '=', $user->id)->pluck("nominations_id");

        return view('admin.manageusers.edit', compact('user', 'countries', 'maleNominations', 'femaleNominations', 'userSelectedNomination'));
    }

    public function update(Request $request, $id)
    {
        $user = User::find($id);
        $user->full_name = $request->full_name ?? $user->full_name;
        $user->username = $request->username ?? $user->username;
        $user->email = $request->email ?? $user->email;
        $user->phone_no = $request->phone_no ?? $user->phone_no;
        $user->country = $request->country ?? $user->country;
        $user->nationality = $request->nationality ?? $user->nationality;
//        $user->gender = $request->gender ?? $user->gender;
        $user->date_of_birth = $request->date_of_birth ?? $user->date_of_birth;
        $user->zodiac = $request->zodiac ?? $user->zodiac;
        $user->hobbies = $request->hobbies ?? $user->hobbies;
        $user->bio = $request->bio ?? $user->bio;
        $user->update();

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
                        UserNomination::where("user_id", "=", $user->id)
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
                        UserNomination::where("user_id", "=", $user->id)
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

        return redirect()->route('admin.manageUser.list')
            ->with('success', 'User has been updated successfully.');
    }

    public function delete($id)
    {
        $user = User::find($id);
        $user->galleries()->delete();
        $user->videos()->delete();
        $user->nominations()->delete();
        $user->comments()->delete();
        $user->likes()->delete();
        $user->rating()->delete();
        $user->votes()->delete();
        $user->availableVote()->delete();
        $user->delete();

        return redirect()->route('admin.manageUser.list')
            ->with('success', 'User has been deleted successfully.');
    }

    public function deleteAll(Request $request)
    {
        $ids = $request->ids;
        User::whereIn('id', explode(",", $ids))->delete();
        return response()->json(['success' => "Users Deleted successfully."]);
    }


    public function editStatus(Request $request, $id)
    {
        $user = User::find($id);
        $user->block = $request->status == "on" ? 1 : 0;
        $user->update();
        return redirect()->route('admin.manageUser.list');
    }

    public function editCommentingStatus(Request $request, $id)
    {
        $userAction = UserAction::find($id);
        $userAction->commenting = $request->status == "on" ? 1 : 0;
        $userAction->update();

        if ($request->status == "on") {
            Notification::create([
                "user_id" => $userAction->user_id,
                "message" => "You can't comment any more. Your commenting is blocked by Admin!"
            ]);
        }

        return redirect()->route('admin.manageUser.list');
    }

    public function editLikingStatus(Request $request, $id)
    {
        $userAction = UserAction::find($id);
        $userAction->liking = $request->status == "on" ? 1 : 0;
        $userAction->update();

        if ($request->status == "on") {
            Notification::create([
                "user_id" => $userAction->user_id,
                "message" => "You can't like any more. Your liking is blocked by Admin!"
            ]);
        }


        return redirect()->route('admin.manageUser.list');
    }

    public function editVotingStatus(Request $request, $id)
    {
        $userAction = UserAction::find($id);
        $userAction->voting = $request->status == "on" ? 1 : 0;
        $userAction->update();

        if ($request->status == "on") {
            Notification::create([
                "user_id" => $userAction->user_id,
                "message" => "You can't vote any more. Your voting is blocked by Admin!"
            ]);
        }

        return redirect()->route('admin.manageUser.list');
    }

    public function editRatingStatus(Request $request, $id)
    {
        $userAction = UserAction::find($id);
        $userAction->rating = $request->status == "on" ? 1 : 0;
        $userAction->update();

        if ($request->status == "on") {
            Notification::create([
                "user_id" => $userAction->user_id,
                "message" => "You can't rate any more. Your rating is blocked by Admin!"
            ]);
        }

        return redirect()->route('admin.manageUser.list');
    }


    public function editImage($id)
    {
        $userGallery = UserGallery::find($id);
        return view('admin.manageusers.editimage', compact('userGallery'));
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

        return redirect()->route('admin.manageUser.view', ["id" => $userGallery->user_id]);
    }

    public function deleteImage($id)
    {
        $userGallery = UserGallery::find($id);
        $userId = $userGallery->user_id;
        $userGallery->delete();

        return redirect()->route('admin.manageUser.view', ["id" => $userId]);
    }

    public function editVideo($id)
    {
        $userVideo = UserVideo::find($id);
        return view('admin.manageusers.editvideo', compact('userVideo'));
    }

    public function updateVideo(Request $request, $id)
    {
        if ($request->file('video')) {
            $path = $request->file('video')->store('/public/users/videos', ['disks' => 'public']);
        }

        $userVideo = UserVideo::find($id);
        $userVideo->video = $path ?? $userVideo->video;
        $userVideo->video_url = $request->video_url ?? $userVideo->video_url;
        $userVideo->description = $request->description ?? $userVideo->description;
        $userVideo->update();

        return redirect()->route('admin.manageUser.view', ["id" => $userVideo->user_id]);
    }

    public function deleteVideo($id)
    {
        $userVideo = UserVideo::find($id);
        $userId = $userVideo->user_id;
        $userVideo->delete();

        return redirect()->route('admin.manageUser.view', ["id" => $userId]);
    }

    public function editUrl($id)
    {
        $userUrl = UserUrl::find($id);
        return view('admin.manageusers.editurl', compact('userUrl'));
    }

    public function updateUrl(Request $request, $id)
    {
        $userUrl = UserUrl::find($id);
        $userUrl->url = $request->url ?? $userUrl->url;
        $userUrl->update();

        return redirect()->route('admin.manageUser.view', ["id" => $userUrl->user_id]);
    }

    public function deleteUrl($id)
    {
        $userUrl = UserUrl::find($id);
        $userId = $userUrl->user_id;
        $userUrl->delete();

        return redirect()->route('admin.manageUser.view', ["id" => $userId]);
    }


    public function blockAll(Request $request)
    {
        $ids = $request->ids;
        $users = User::whereIn('id', explode(",", $ids))->get();
        foreach ($users as $user) {
            $user->block = 1;
            $user->save();
        }
        return response()->json(['success' => "Users Block successfully."]);
    }

    public function unBlockAll(Request $request)
    {
        $ids = $request->ids;
        $users = User::whereIn('id', explode(",", $ids))->get();
        foreach ($users as $user) {
            $user->block = 0;
            $user->save();
        }
        return response()->json(['success' => "Users Unblock successfully."]);
    }

    public function download()
    {
        $users = User::orderBy('id', 'DESC')->get();
        return (new FastExcel($users))->download('users.xlsx');
    }
}
