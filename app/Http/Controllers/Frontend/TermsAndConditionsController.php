<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\CorporatePage;
use Illuminate\Http\Request;

class TermsAndConditionsController extends Controller
{
    public function index()
    {
        $data = CorporatePage::where('key', '=', 'terms_and_conditions')->first();
        return view("frontend.termsandconditions", compact('data'));
    }
}
