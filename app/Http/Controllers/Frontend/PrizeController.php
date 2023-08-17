<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\CorporatePage;
use Illuminate\Http\Request;

class PrizeController extends Controller
{
    public function index()
    {
        $data = CorporatePage::where('key', '=', 'prizes')->first();
        return view("frontend.prize", compact('data'));
    }
}
