<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Mail\Message;
use App\Models\Notification;
use App\Models\Order;
use App\Models\User;
use App\Models\UserVote;
use App\Models\VotePlan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class VotePlanController extends Controller
{
    public function index()
    {
        $votePlans = VotePlan::all();

        return response()->json([
            "data" => \App\Http\Resources\VotePlan::collection($votePlans),
        ], 200);
    }


    public function buyVotes(Request $request, $id)
    {
        $validation = Validator::make($request->all(), [
            'cardNumber' => ['required', 'regex:/^(?:4[0-9]{12}(?:[0-9]{3})?|5[1-5][0-9]{14}|6(?:011|5[0-9][0-9])[0-9]{12}|3[47][0-9]{13}|3(?:0[0-5]|[68][0-9])[0-9]{11}|(?:2131|1800|35\d{3})\d{11})$/'],
            'cardholderName' => 'required|string',
            'month' => 'required|numeric',
            'year' => 'required|numeric',
            'cvv' => 'required|numeric|digits:3',
        ]);

        if ($validation->fails()) {
            $response = [
                'errors' => $validation->errors()
            ];

            return response()->json($response, 400);
        }

        $user = User::find($request->user()->id);

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

        return response()->json([
            "data" => new \App\Http\Resources\User($user)
        ], 200);
    }
}
