<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ParticipatingCountry;
use Illuminate\Http\Request;

class ParticipatingCountriesController extends Controller
{
    public function index() {
        $participatingCountries = ParticipatingCountry::orderBy('id', 'DESC')->get();
        return view("admin.corporatepages.participatingcountries.index", compact('participatingCountries'));
    }

    public function add()
    {
        return view("admin.corporatepages.participatingcountries.add");
    }


    public function insert(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string',
            'flag' => 'required'
        ]);

        $path = $request->file('flag')->store('/public/flags', ['disks' => 'public']);

        $participatingCountry = new ParticipatingCountry();
        $participatingCountry->name = $request->name;
        $participatingCountry->flag = $path;
        $participatingCountry->status = 1;
        $participatingCountry->save();

        return redirect()->route('admin.participatingCountries.list')
            ->with('success', 'Country has been added successfully!');
    }


    public function edit($id)
    {
        $participatingCountry = ParticipatingCountry::find($id);
        return view("admin.corporatepages.participatingcountries.edit", compact('participatingCountry'));
    }


    public function update(Request $request, $id)
    {
        if ($request->file('flag')) {
            $path = $request->file('flag')->store('/public/flags', ['disks' => 'public']);
        }

        $participatingCountry = ParticipatingCountry::find($id);
        $participatingCountry->name = $request->name ?? $participatingCountry->name;
        $participatingCountry->flag = $path ?? $participatingCountry->flag;
        $participatingCountry->update();

        return redirect()->route('admin.participatingCountries.list')
            ->with('success', 'Country has been updated successfully!');
    }


    public function delete($id)
    {
        ParticipatingCountry::find($id)->delete();

        return redirect()->route('admin.nominations.list')
            ->with('success', 'Country has been deleted successfully!');
    }

    public function editStatus(Request $request, $id)
    {
        $participatingCountry = ParticipatingCountry::find($id);
        $participatingCountry->status = $request->status == "on" ? 0 : 1;
        $participatingCountry->update();
        return redirect()->route('admin.participatingCountries.list');
    }
}
