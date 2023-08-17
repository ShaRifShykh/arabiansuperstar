<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\CorporatePage;
use App\Models\FAQ;
use Illuminate\Http\Request;

class FaqController extends Controller
{
    public function index()
    {
        $faqs = FAQ::orderByRaw('FIELD(f_a_q_s.id, 19) DESC')
            ->orderBy('id', 'ASC')->get();
        $data = CorporatePage::where('key', '=', 'faqs')->first();
        return view("frontend.faq", compact('data', 'faqs'));
    }
}
