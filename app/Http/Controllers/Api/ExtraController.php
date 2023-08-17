<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\CorporatePage;
use App\Models\FAQ;
use Illuminate\Http\Request;

class ExtraController extends Controller
{
    public function termsAndCondition()
    {
        $termsAndCondition = CorporatePage::where('key', '=', 'terms_and_conditions')->first()->content;

        return response()->json([
            "data" => $termsAndCondition,
        ], 200);
    }


    public function faqs()
    {
        $faqs = FAQ::all();

        return response()->json([
            "data" => $faqs,
        ], 200);
    }

    public function howItWorks()
    {
        $howItWorks = CorporatePage::where('key', '=', 'how_it_works')->first()->content;

        return response()->json([
            "data" => $howItWorks,
        ], 200);
    }
}
