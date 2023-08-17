<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\FAQ;
use App\Models\Judge;
use Illuminate\Http\Request;

class JudgeController extends Controller
{
    public function index()
    {
        $judges = Judge::orderBy('id', 'DESC')->get();
        return view('admin.corporatepages.judges.index', compact('judges'));
    }


    public function add()
    {
        return view('admin.corporatepages.judges.add');
    }


    public function insert(Request $request)
    {
        $path = $request->file('icon')->store('/public/judges', ['disks' => 'public']);

        $judge = new Judge();
        $judge->icon = $path;
        $judge->heading = $request->heading;
        $judge->save();

        return redirect()->route('admin.judges.list')
            ->with('success', 'Judge has been added successfully!');
    }


    public function edit($id)
    {
        $judge = Judge::find($id);
        return view("admin.corporatepages.judges.edit", compact('judge'));
    }


    public function update(Request $request, $id)
    {
        if ($request->file('icon')) {
            $path = $request->file('icon')->store('/public/judges', ['disks' => 'public']);
        }
        $judge = Judge::find($id);
        $judge->icon = $path ?? $judge->icon;
        $judge->heading = $request->heading ?? $judge->heading;
        $judge->save();

        return redirect()->route('admin.judges.list')
            ->with('success', 'Judge has been updated successfully!');
    }


    public function delete($id)
    {
        Judge::find($id)->delete();

        return redirect()->route('admin.judges.list')
            ->with('success', 'Judge has been deleted successfully!');
    }
}
