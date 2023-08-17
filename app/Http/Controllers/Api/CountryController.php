<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Country;
use App\Models\ParticipatingCountry;
use Illuminate\Http\Request;

class CountryController extends Controller
{
    public function index()
    {
        $data = Country::all();

        return response()->json([
            "data" => $data
        ], 200);
    }

    public function countriesToShow()
    {
        $data = ParticipatingCountry::where("status", "=", 0)->get();

        return response()->json([
            "data" => $data
        ], 200);
    }
}
