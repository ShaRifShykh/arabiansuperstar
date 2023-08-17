<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use Illuminate\Http\Request;
use Rap2hpoutre\FastExcel\FastExcel;

class UserCommentController extends Controller
{
    public function index()
    {
        $comments = Comment::orderBy('id', 'Desc')->get();
        return view('admin.usercomment.index', compact('comments'));
    }

    public function edit($id)
    {
        $comment = Comment::find($id);
        return view('admin.usercomment.edit', compact('comment'));
    }

    public function update(Request $request, $id)
    {
        $comment = Comment::find($id);
        $comment->comment = $request->comment ?? $comment->comment;
        $comment->update();

        return redirect()->route('admin.userAllComments.list')
            ->with('success', 'Comment has been updated successfully!');
    }

    public function delete($id)
    {
        Comment::find($id)->delete();

        return redirect()->route('admin.userAllComments.list')
            ->with('success', 'Comment has been deleted successfully!');
    }

    public function editStatus(Request $request, $id)
    {
        $comment = Comment::find($id);
        $comment->block = $request->status == "on" ? 1 : 0;
        $comment->update();
        return redirect()->route('admin.userAllComments.list');
    }

    public function download()
    {
        $comments = Comment::orderBy('id', 'DESC')->get();
        return (new FastExcel($comments))->download('comments.xlsx');
    }
}
