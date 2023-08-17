<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Associate;
use App\Models\CorporatePage;
use Illuminate\Http\Request;

class SponsorshipController extends Controller
{
    public function index()
    {
        $data = CorporatePage::where('key', '=', 'sponsorship')->first();
        $associates = Associate::all();
        return view("frontend.sponsorship", compact('data', 'associates'));
    }
}
