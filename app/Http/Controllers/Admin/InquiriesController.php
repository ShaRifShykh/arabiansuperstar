<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Inquiry;
use Illuminate\Http\Request;
use Rap2hpoutre\FastExcel\FastExcel;

class InquiriesController extends Controller
{
    public function index()
    {
        $inquiries = Inquiry::orderBy('id', 'DESC')->get();
        return view("admin.inquiries.index", compact('inquiries'));
    }

    public function edit($id)
    {
        $inquiry = Inquiry::find($id);
        return view('admin.inquiries.edit', compact('inquiry'));
    }

    public function update(Request $request, $id)
    {
        $inquiry = Inquiry::find($id);
        $inquiry->full_name = $request->full_name ?? $inquiry->full_name;
        $inquiry->phone_no = $request->phone_no ?? $inquiry->phone_no;
        $inquiry->email = $request->email ?? $inquiry->email;
        $inquiry->message = $request->message ?? $inquiry->message;
        $inquiry->save();

        return redirect()->route('admin.inquiries.list')
            ->with('success', 'Inquiry has been updated successfully!');
    }

    public function delete($id)
    {
        Inquiry::find($id)->delete();
        return redirect()->route('admin.inquiries.list')
            ->with('success', 'Inquiry has been deleted successfully!');
    }

    public function download()
    {
        $inquiries = Inquiry::orderBy('id', 'DESC')->get();
        return (new FastExcel($inquiries))->download('inquiries.xlsx');
    }
}
