<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\CorporatePage;
use App\Models\Judge;
use Illuminate\Http\Request;

class JudgesController extends Controller
{
    public function index()
    {
        $data = CorporatePage::where('key', '=', 'judges')->first();
        $judges = Judge::all();
        return view("frontend.judges", compact('data', 'judges'));
    }
}
