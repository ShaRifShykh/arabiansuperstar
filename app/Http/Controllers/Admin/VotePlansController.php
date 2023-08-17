<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\VotePlan;
use Illuminate\Http\Request;
use Rap2hpoutre\FastExcel\FastExcel;

class VotePlansController extends Controller
{

    public function index()
    {
        $votePlans = VotePlan::orderBy('id', 'DESC')->get();
        return view('admin.voteplans.index', compact('votePlans'));
    }


    public function add()
    {
        return view('admin.voteplans.add');
    }


    public function insert(Request $request)
    {
        $this->validate($request, [
            'plan_name' => 'required|string',
            'votes' => 'required|numeric',
            'price' => 'required|string',
        ]);

        VotePlan::create([
            "plan_name" => $request->plan_name,
            "votes" => $request->votes,
            "price" => $request->price
        ]);

        return redirect()->route('admin.votePlans.list')
            ->with('success', 'Vote Plan has been added successfully.');
    }


    public function edit($id)
    {
        $votePlan = VotePlan::find($id);
        return view('admin.voteplans.edit', compact('votePlan'));
    }


    public function update(Request $request, $id)
    {
        $votePlan = VotePlan::find($id);
        $votePlan->plan_name = $request->plan_name ?? $votePlan->plan_name;
        $votePlan->votes = $request->votes ?? $votePlan->votes;
        $votePlan->price = $request->price ?? $votePlan->price;
        $votePlan->update();

        return redirect()->route('admin.votePlans.list')
            ->with('success', 'Vote Plan has been updated successfully!');
    }


    public function delete($id)
    {
        $votePlan = VotePlan::find($id)->delete();
        return redirect()->route('admin.votePlans.list')
            ->with('success', 'Vote Plan has been deleted successfully!');
    }

    public function download()
    {
        $votePlans = VotePlan::orderBy('id', 'DESC')->get();
        return (new FastExcel($votePlans))->download('votePlans.xlsx');
    }
}
