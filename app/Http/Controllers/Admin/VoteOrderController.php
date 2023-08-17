<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\VotePlan;
use Illuminate\Http\Request;
use Rap2hpoutre\FastExcel\FastExcel;

class VoteOrderController extends Controller
{
    public function index()
    {
        $voteOrders = Order::orderBy('id', 'DESC')->get();
        return view('admin.voteorders.index', compact('voteOrders'));
    }

    public function edit($id)
    {
        $voteOrder = Order::find($id);
        $votePlans = VotePlan::all();
        return view('admin.voteorders.edit', compact('voteOrder', 'votePlans'));
    }

    public function update(Request $request, $id)
    {
        $voteOrder = Order::find($id);
        $voteOrder->vote_plan_id = $request->plan_id ?? $voteOrder->vote_plan_id;
        $voteOrder->total_amount = $request->total_amount ?? $voteOrder->total_amount;
        $voteOrder->payment_status = $request->payment_status ?? $voteOrder->payment_status;
        $voteOrder->update();

        return redirect()->route('admin.voteOrders.list')
            ->with('success', 'Order has been updated successfully.');
    }

    public function delete($id)
    {
        Order::find($id)->delete();
        return redirect()->route('admin.voteOrders.list')
            ->with('success', 'Order has been deleted successfully!');
    }

    public function download()
    {
        $orders = Order::orderBy('id', 'DESC')->get();
        return (new FastExcel($orders))->download('voteOrders.xlsx');
    }
}
