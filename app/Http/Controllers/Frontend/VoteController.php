<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Mail\EmailVerificationMail;
use App\Mail\Message;
use App\Models\Notification;
use App\Models\Order;
use App\Models\User;
use App\Models\UserCreditCard;
use App\Models\UserVote;
use App\Models\VotePlan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class VoteController extends Controller
{
    public function myVotesBucket()
    {
        $user = Auth::guard("web")->user();
        return view("frontend.votes.myvotesbucket", compact("user"));
    }

    public function votesPurchasedView()
    {
        return view("frontend.votes.votespurchased");
    }

    public function sendVotes(Request $request, $id)
    {
        $user = User::find($id);
        $userToSendVote = UserVote::where("user_id", "=", $id)->first();
        $myVotes = UserVote::find(Auth::guard("web")->user()->availableVote->id);

        if ($myVotes->votes_available > 0) {
            $userToSendVote->total_voting += 1;
            $userToSendVote->update();

            $myVotes->votes_available -= 1;
            $myVotes->update();

            if ($request->user()->id != $id) {
                Notification::create([
                    "user_id" => $id,
                    "message" => "You have received a vote from " . Auth::guard("web")->user()->username,
                ]);
            }

            return redirect()->route("usersProfile", ["username" => $user->username]);
        }

        return redirect()->route("buyVotesView");
    }

    public function buyVotesView()
    {
        $votePlans = VotePlan::all();
        return view("frontend.votes.buyvotes", compact("votePlans"));
    }

    public function checkout($id)
    {
        $votePlan = VotePlan::find($id);
        $card = UserCreditCard::where("user_id", "=", Auth::guard("web")->id())->first();
        return view("frontend.votes.checkout", compact("votePlan", "card"));
    }

    public function buyVotes(Request $request, $id)
    {
        $this->validate($request, [
            'card_number' => ['required', 'regex:/^(?:4[0-9]{12}(?:[0-9]{3})?|5[1-5][0-9]{14}|6(?:011|5[0-9][0-9])[0-9]{12}|3[47][0-9]{13}|3(?:0[0-5]|[68][0-9])[0-9]{11}|(?:2131|1800|35\d{3})\d{11})$/'],
            'cardholder_name' => 'required|string',
            'month' => 'required|numeric',
            'year' => 'required',
            'cvv_number' => 'required|numeric|digits:3',
        ]);

        $votePlan = VotePlan::find($id);

        $user = User::with("creditCard")->find(Auth::guard("web")->id());

//        if ($user->creditCard != null) {
//            $card = UserCreditCard::find($user->creditCard->id);
//            $card->card_number = $request->card_number;
//            $card->cardholder_name = $request->cardholder_name;
//            $card->month = $request->month;
//            $card->year = $request->year;
//            $card->cvv_number = $request->cvv_number;
//            $card->save();
//        } else {
//            if ($request->remember == 1) {
//                UserCreditCard::create([
//                    "user_id" => $user->id,
//                    "card_number" => $request->card_number,
//                    "cardholder_name" => $request->cardholder_name,
//                    "month" => $request->month,
//                    "year" => $request->year,
//                    "cvv_number" => $request->cvv_number
//                ]);
//            }
//        }

        $votePlan = VotePlan::find($id);
        $userVote = UserVote::where("user_id", "=", $user->id)->first();

        $order = new Order();
        $order->vote_plan_id = $id;
        $order->user_id = $user->id;
        $order->order_id = rand(1000, 99999);
//        $order->payment_status = "Pending";
        $order->payment_status = "Completed";
        $order->total_amount = $votePlan->price;
        $order->save();

        $mailData = [
            'subject' => 'Purchased successful!',
            'title' => 'Votes purchased successfully',
            'body' => "You have purchased " . $votePlan->votes . " votes for " . $votePlan->price . ". Here is the order no: " . $order->order_id,
        ];

        Mail::to($user->email)->send(new Message($mailData));

        Notification::create([
            "user_id" => $user->id,
            "message" => "You have purchased " . $votePlan->votes . " votes successfully!",
        ]);

        if ($order->payment_status == "Completed") {
            $userVote->votes_available += $votePlan->votes;
            $userVote->save();
        }

        return redirect()->route('votesPurchasedView');
    }
}
