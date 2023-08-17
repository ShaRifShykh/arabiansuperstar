<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Associate;
use App\Models\CorporatePage;
use Illuminate\Http\Request;

class AssociationController extends Controller
{
    public function index()
    {
        $data = CorporatePage::where('key', '=', 'associates')->first();
        $associates = Associate::all();
        return view("frontend.association", compact('data', 'associates'));
    }
}
