<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\CorporatePage;
use App\Models\HostCity;
use Illuminate\Http\Request;

class HostCityController extends Controller
{
    public function index()
    {
        $data = CorporatePage::where('key', '=', 'host_city')->first();
        $hostCities = HostCity::all();
        return view("frontend.hostcity", compact('data', 'hostCities'));
    }
}
