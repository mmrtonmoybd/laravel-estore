<?php
/*
Author: Moshiur Rahman Tonmoy
Facebook: https://www.facebook.com/mmrtonmoy
GitHub: https://www.github.com/mmrtonmoybd
About: I am a php, laravel, codeigniter developer.
*/

namespace App\Http\Controllers;

use App\Comment;
use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class CommentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function store(Request $request)
    {
        $request->validate([
            'id' => 'required|integer|exists:products,id',
            'comment' => 'required|string',
        ]);

        $product = Product::find($request->input('id'));
        $user = Auth::user();
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
        $user = Auth::user();
        Comment::create([
            'commentable_id' => $request->input('cid'),
            'commentable_type' => 'App\Comment',
            'commented_id' => $user->id,
            'commented_type' => get_class($user),
            'comment' => $request->input('comment'),
        ]);

        return redirect("/product/{$request->input('pid')}")->with('success', 'Reply is successfull');
    }

    public function comedit(Comment $id)
    {
        $this->checkAuthrize($id);

        return view('comedit', [
            'comment' => $id,
        ]);
    }

    public function comeditp(Request $request, Comment $id)
    {
        $this->checkAuthrize($id);
        $this->validatereq($request);
        $id->comment = $request->input('comment');
        $id->save();
        if ($id->commented_type = 'App\\Product') {
            return redirect("/product/{$id->commentable_id}")->with('success', 'Comment is updated');
        }
        $find = Comment::find($id->commented_id);

        return redirect("/product/{$find->commented_id}")->with('success', 'Reply is updated');
    }

    public function delete(Comment $id)
    {
        $this->checkAuthrize();
        if ($id->commentable_type = 'App\Comment') {
            Comment::where('commentable_id', $id->id)->delete();
        }
        $id->delete();
        if ('App\\Product' == $id->commented_type) {
            return redirect("/product/{$id->commentable_id}")->with('success', 'Comment is deleted');
        }
        $find = Comment::find($id->commented_id);

        return redirect("/product/{$find->commented_id}")->with('success', 'Reply is deleted');
    }

    private function validatereq($request)
    {
        return $request->validate([
            'comment' => 'required|string',
        ]);
    }

    private function checkAuthrize($id)
    {
        return Gate::authorize('isAction', $id->id);
    }
}
