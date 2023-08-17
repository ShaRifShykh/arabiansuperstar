<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CorporatePage;
use Illuminate\Http\Request;

class CorporatePagesController extends Controller
{
    public function index()
    {
        return view('admin.corporatepages.index');
    }

    public function edit($key)
    {
        $data = CorporatePage::where("key", "=", $key)->first();
        return view('admin.corporatepages.edit', compact('data'));
    }

    public function update(Request $request, $key)
    {
        $data = CorporatePage::where("key", "=", $key)->first();

        if ($request->file('banner')) {
            $path = $request->file('banner')->store('/public/banners', ['disks' => 'public']);
        }

        $data->banner = $path ?? $data->banner;
        $data->heading = $request->heading ?? $data->heading;
        $data->sub_heading = $request->sub_heading;
        $data->content = $request->content;
        $data->save();

        return redirect()->route('admin.corporatePages.list')
            ->with('success', 'Page updated successfully!');
    }
}
