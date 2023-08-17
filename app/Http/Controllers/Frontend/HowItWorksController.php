<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\CorporatePage;
use Illuminate\Http\Request;

class HowItWorksController extends Controller
{
    public function index()
    {
        $data = CorporatePage::where('key', '=', 'how_it_works')->first();
        return view("frontend.howitworks", compact('data'));
    }
}
