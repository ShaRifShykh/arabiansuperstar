<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\CorporatePage;
use App\Models\ParticipatingCountry;
use Illuminate\Http\Request;

class ParticipatingCountriesController extends Controller
{
    public function index()
    {
        $countries = ParticipatingCountry::where('status', '=', 0)->get();
        $data = CorporatePage::where('key', '=', 'countries')->first();
        return view("frontend.participatingcountries", compact('countries', 'data'));
    }
}
