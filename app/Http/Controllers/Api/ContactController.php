<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Inquiry;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class ContactController extends Controller
{
    public function create(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'full_name' => 'required|string',
            'email' => 'required|email',
            'phone_no' => 'required',
            'message' => 'required',
        ]);

        if ($validation->fails()) {
            $response = [
                'errors' => $validation->errors()
            ];

            return response()->json($response, 400);
        }

        Inquiry::create([
            'full_name' => $request->full_name,
            'email' => $request->email,
            'phone_no' => $request->phone_no,
            'message' => $request->message
        ]);

        $mailData = [
            'email' => $request->email,
            'full_name' => $request->full_name,
            'phone_no' => $request->phone_no,
            'message' => $request->message,
            'from' => "mohd.ahmad5657@gmail.com"
        ];

        Mail::to(env("MAIL_USERNAME"))->send(new \App\Mail\Inquiry($mailData));


        $response = [
            'success' => 'Mailed Successfully'
        ];

        return response()->json($response, 200);
    }
}
