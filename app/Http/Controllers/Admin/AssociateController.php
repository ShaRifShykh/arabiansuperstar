<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Associate;
use Illuminate\Http\Request;

class AssociateController extends Controller
{
    public function index()
    {
        $associates = Associate::orderBy('id', 'DESC')->get();
        return view('admin.corporatepages.associate.index', compact('associates'));
    }


    public function add()
    {
        return view('admin.corporatepages.associate.add');
    }


    public function insert(Request $request)
    {
        $path = $request->file('bg_image')->store('/public/associates', ['disks' => 'public']);

        $associate = new Associate();
        $associate->bg_image = $path;
        $associate->heading = $request->heading;
        $associate->description = $request->description;
        $associate->save();

        return redirect()->route('admin.associates.list')
            ->with('success', 'Associate has been added successfully!');
    }


    public function edit($id)
    {
        $associate = Associate::find($id);
        return view("admin.corporatepages.associate.edit", compact('associate'));
    }


    public function update(Request $request, $id)
    {
        if ($request->file('bg_image')) {
            $path = $request->file('bg_image')->store('/public/associates', ['disks' => 'public']);
        }
        $associate = Associate::find($id);
        $associate->bg_image = $path ?? $associate->bg_image;
        $associate->heading = $request->heading ?? $associate->heading;
        $associate->description = $request->description ?? $associate->description;
        $associate->save();

        return redirect()->route('admin.associates.list')
            ->with('success', 'Associate has been updated successfully!');
    }


    public function delete($id)
    {
        Associate::find($id)->delete();

        return redirect()->route('admin.associates.list')
            ->with('success', 'Associate has been deleted successfully!');
    }
}
