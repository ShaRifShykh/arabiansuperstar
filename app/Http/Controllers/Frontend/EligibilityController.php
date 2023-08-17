<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\CorporatePage;
use Illuminate\Http\Request;

class EligibilityController extends Controller
{
    public function index()
    {
        $data = CorporatePage::where('key', '=', 'eligibility')->first();
        return view("frontend.eligibility", compact('data'));
    }
}
