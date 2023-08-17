<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Slider;
use Illuminate\Http\Request;

class CommentSliderController extends Controller
{
    public function index()
    {
        $sliders = Slider::where('key', "=", "comment_left")
            ->orWhere('key', '=', 'comment_right')
            ->orderBy('id', 'DESC')->get();
        return view('admin.corporatepages.comment.index', compact('sliders'));
    }


    public function add()
    {
        return view('admin.corporatepages.comment.add');
    }


    public function insert(Request $request)
    {
        $path = $request->file('image')->store('/public/sliders', ['disks' => 'public']);

        $slider = new Slider();
        $slider->key = $request->key;
        $slider->image = $path;
        $slider->save();

        return redirect()->route('admin.sliders.comment.list')
            ->with('success', 'Comment Slider has been added successfully!');
    }


    public function edit($id)
    {
        $slider = Slider::find($id);
        return view("admin.corporatepages.comment.edit", compact('slider'));
    }


    public function update(Request $request, $id)
    {
        if ($request->file("image")) {
            $path = $request->file('image')->store('/public/sliders', ['disks' => 'public']);
        }

        $slider = Slider::find($id);
        $slider->key = $request->key ?? $slider->key;
        $slider->image = $path ?? $slider->image;
        $slider->save();

        return redirect()->route('admin.sliders.comment.list')
            ->with('success', 'Comment Slider has been updated successfully!');
    }


    public function delete($id)
    {
        Slider::find($id)->delete();

        return redirect()->route('admin.sliders.comment.list')
            ->with('success', 'Comment Slider has been deleted successfully!');
    }
}
