<?php
/*
Author: Moshiur Rahman Tonmoy
Facebook: https://www.facebook.com/mmrtonmoy
GitHub: https://www.github.com/mmrtonmoybd
About: I am a php, laravel, codeigniter developer.
*/

namespace App\Http\Controllers\Admin;

use App\Comment;
use App\Http\Controllers\Controller;
use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function index()
    {
        return view('admin.comments', [
            'comments' => Comment::latest()->paginate(\App\Setting::getValue('item_per_page')),
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'id' => 'required|integer|exists:products,id',
            'comment' => 'required|string',
        ]);

        $product = Product::find($request->input('id'));
        $user = Auth::guard('admin')->user();

        $user->comment($product, $request->input('comment'));

        return redirect("/product/{$request->input('id')}")->with('success', 'Comment is successfull');
    }

    public function reply(Request $request)
    {
        $request->validate([
            'comment' => 'required|string',
            'cid' => 'required|integer|exists:comments,id',
            'pid' => 'required|integer|exists:products,id',
        ]);
        $user = Auth::guard('admin')->user();
        Comment::create([
            'commentable_id' => $request->input('cid'),
            'commentable_type' => 'App\Comment',
            'commented_id' => $user->id,
            'commented_type' => get_class($user),
            'comment' => $request->input('comment'),
        ]);

        return redirect("/product/{$request->input('pid')}")->with('success', 'Reply is successfull');
    }

    public function showForm(Comment $id)
    {
        return view('admin.commentupdate', [
            'comment' => $id,
        ]);
    }

    public function update(Request $request, Comment $id)
    {
        $request->validate([
            'comment' => 'required|string',
        ]);
        $id->comment = $request->input('comment');
        $id->save();

        return redirect()->route('admin.comment.list')->with('success', 'Comment/Reply updated successful');
    }

    public function delete(Comment $id)
    {
        //$id->delete();
        if ($id->commentable_type = 'App\Comment') {
            Comment::where('commentable_id', $id->id)->delete();
        }
        $id->delete();

        return redirect()->route('admin.comment.list')->with('success', 'Comment/Reply deleted successful');
    }
}
