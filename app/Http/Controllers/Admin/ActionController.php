<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Action;
use Illuminate\Http\Request;

class ActionController extends Controller
{
    public function index() {
        $actions = Action::all();
        return view('admin.action.index', compact('actions'));
    }

    public function editStatus(Request $request, $id)
    {
        $action = Action::find($id);
        $action->block = $request->status == "on" ? 1 : 0;
        $action->update();
        return redirect()->route('admin.actions.list');
    }
}
