<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Inquiry;
use App\Models\Order;
use App\Models\User;
use App\Models\User360;
use App\Models\User72;
use App\Models\VotePlan;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $totalUsers = User::where("email_verified_at", "!=", null)->get()->count();
        $totalMaleUsers = User::where("email_verified_at", "!=", null)
            ->where('gender', '=', 'Male')->get()->count();
        $totalFemaleUsers = User::where("email_verified_at", "!=", null)
            ->where('gender', '=', 'Female')->get()->count();
        $totalVotePlans = VotePlan::all()->count();
        $totalOrders = Order::all()->count();
        $totalInquiries = Inquiry::all()->count();
        $totalUsersOf360 = User360::all()->count();
        $totalUsersOf72 = User72::all()->count();

        return view('admin.dashboard',
            compact('totalUsers', 'totalMaleUsers', 'totalFemaleUsers', 'totalVotePlans', 'totalOrders', 'totalInquiries', 'totalUsersOf360', 'totalUsersOf72'));
    }
}
