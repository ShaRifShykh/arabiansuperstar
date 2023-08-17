<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\FAQ;
use Illuminate\Http\Request;

class FAQController extends Controller
{
    public function index()
    {
        $faqs = FAQ::orderByRaw('FIELD(f_a_q_s.id, 19) DESC')
            ->orderBy('id', 'ASC')->get();
        return view("admin.corporatepages.faqs.index", compact('faqs'));
    }


    public function add()
    {
        return view("admin.corporatepages.faqs.add");
    }


    public function insert(Request $request)
    {
        $faq = new FAQ();
        $faq->question = $request->question;
        $faq->answer = $request->answer;
        $faq->save();

        return redirect()->route('admin.faqs.list')
            ->with('success', 'FAQ has been added successfully!');
    }


    public function edit($id)
    {
        $faq = FAQ::find($id);
        return view("admin.corporatepages.faqs.edit", compact('faq'));
    }


    public function update(Request $request, $id)
    {
        $faq = FAQ::find($id);
        $faq->question = $request->question ?? $faq->question;
        $faq->answer = $request->answer ?? $faq->answer;
        $faq->save();

        return redirect()->route('admin.faqs.list')
            ->with('success', 'FAQ has been updated successfully!');
    }


    public function delete($id)
    {
        FAQ::find($id)->delete();

        return redirect()->route('admin.faqs.list')
            ->with('success', 'FAQ has been deleted successfully!');
    }
}
