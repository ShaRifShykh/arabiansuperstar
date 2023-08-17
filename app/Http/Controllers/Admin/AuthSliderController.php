<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Slider;
use Illuminate\Http\Request;

class AuthSliderController extends Controller
{
    public function index()
    {
        $sliders = Slider::where('key', "=", "auth")->orderBy('id', 'DESC')->get();
        return view('admin.corporatepages.auth.index', compact('sliders'));
    }


    public function add()
    {
        return view('admin.corporatepages.auth.add');
    }


    public function insert(Request $request)
    {
        $path = $request->file('image')->store('/public/sliders', ['disks' => 'public']);

        $slider = new Slider();
        $slider->key = "auth";
        $slider->image = $path;
        $slider->save();

        return redirect()->route('admin.sliders.auth.list')
            ->with('success', 'Auth Slider has been added successfully!');
    }


    public function edit($id)
    {
        $slider = Slider::find($id);
        return view("admin.corporatepages.auth.edit", compact('slider'));
    }


    public function update(Request $request, $id)
    {
        $path = $request->file('image')->store('/public/sliders', ['disks' => 'public']);

        $slider = Slider::find($id);
        $slider->image = $path;
        $slider->save();

        return redirect()->route('admin.sliders.auth.list')
            ->with('success', 'Auth Slider has been updated successfully!');
    }


    public function delete($id)
    {
        Slider::find($id)->delete();

        return redirect()->route('admin.sliders.auth.list')
            ->with('success', 'Auth Slider has been deleted successfully!');
    }
}
