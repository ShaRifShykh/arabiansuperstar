<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HostCity;
use Illuminate\Http\Request;

class HostCityController extends Controller
{
    public function index()
    {
        $hostCities = HostCity::orderBy('id', 'DESC')->get();
        return view('admin.corporatepages.hostcity.index', compact('hostCities'));
    }


    public function add()
    {
        return view('admin.corporatepages.hostcity.add');
    }


    public function insert(Request $request)
    {
        $path = $request->file('image')->store('/public/hostCities', ['disks' => 'public']);

        $hostCity = new HostCity();
        $hostCity->image = $path;
        $hostCity->save();

        return redirect()->route('admin.hostCities.list')
            ->with('success', 'Host City has been added successfully!');
    }


    public function edit($id)
    {
        $hostCity = HostCity::find($id);
        return view("admin.corporatepages.hostcity.edit", compact('hostCity'));
    }


    public function update(Request $request, $id)
    {
        $path = $request->file('image')->store('/public/hostCities', ['disks' => 'public']);

        $hostCity = HostCity::find($id);
        $hostCity->image = $path;
        $hostCity->save();

        return redirect()->route('admin.hostCities.list')
            ->with('success', 'Host City has been updated successfully!');
    }


    public function delete($id)
    {
        HostCity::find($id)->delete();

        return redirect()->route('admin.hostCities.list')
            ->with('success', 'Host City has been deleted successfully!');
    }
}
