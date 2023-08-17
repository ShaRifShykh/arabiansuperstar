<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\CorporatePage;
use Illuminate\Http\Request;

class EventTicketController extends Controller
{
    public function index()
    {
        $data = CorporatePage::where('key', '=', 'events_tickets')->first();
        return view("frontend.eventticket", compact('data'));
    }
}
