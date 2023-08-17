<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\CorporatePage;
use App\Models\Inquiry;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function index()
    {
        $data = CorporatePage::where('key', '=', 'contact_us')->first();
        return view("frontend.contact", compact('data'));
    }

    public function create(Request $request)
    {
        $this->validate($request, [
            'full_name' => 'required|string',
            'email' => 'required|email',
            'phone_no' => 'required',
            'message' => 'required',
        ]);

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

        return redirect()->route('contactUs')
            ->with('success', 'Form Submitted Successfully!');
    }
}
