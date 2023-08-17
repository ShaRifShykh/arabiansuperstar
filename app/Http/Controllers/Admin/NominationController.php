<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Nomination;
use Illuminate\Http\Request;
use Rap2hpoutre\FastExcel\FastExcel;

class NominationController extends Controller
{

    public function index()
    {
        $nominations = Nomination::orderBy('id', 'DESC')->get();
        return view('admin.nominations.index', compact('nominations'));
    }


    public function add()
    {
        return view("admin.nominations.add");
    }


    public function insert(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string',
            'gender' => 'required|string'
        ]);

        $nomination = new Nomination();
        $nomination->name = $request->name;
        $nomination->gender = $request->gender;
        $nomination->save();

        return redirect()->route('admin.nominations.list')
            ->with('success', 'Nomination has been added successfully!');
    }


    public function edit($id)
    {
        $nomination = Nomination::find($id);
        return view("admin.nominations.edit", compact('nomination'));
    }


    public function update(Request $request, $id)
    {
        $nomination = Nomination::find($id);
        $nomination->name = $request->name ?? $nomination->name;
        $nomination->gender = $request->gender ?? $nomination->gender;
        $nomination->update();

        return redirect()->route('admin.nominations.list')
            ->with('success', 'Nomination has been updated successfully!');
    }


    public function delete($id)
    {
        $nomination = Nomination::find($id);
        $nomination->userNominations();
        $nomination->delete();

        return redirect()->route('admin.nominations.list')
            ->with('success', 'Nomination has been deleted successfully!');
    }

    public function editStatus(Request $request, $id)
    {
        $nomination = Nomination::find($id);
        $nomination->block = $request->status == "on" ? 1 : 0;
        $nomination->update();
        return redirect()->route('admin.nominations.list');
    }


    public function download()
    {
        $nominations = Nomination::orderBy('id', 'DESC')->get();
        return (new FastExcel($nominations))->download('nominations.xlsx');
    }
}
