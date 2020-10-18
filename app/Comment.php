<?php
/*
Author: Moshiur Rahman Tonmoy
Facebook: https://www.facebook.com/mmrtonmoy
GitHub: https://www.github.com/mmrtonmoybd
About: I am a php, laravel, codeigniter developer.
*/

namespace App;

use Actuallymab\LaravelComment\Models\Comment as LaravelComment;

class Comment extends LaravelComment
{
    protected $with = ['comments'];

    public static function reply(int $comID)
    {
        return Comment::where('commentable_id', $comID)->where('commentable_type', 'App\Comment')->get();
    }

    public static function user(int $id)
    {
        return \App\User::find($id);
    }

    public static function adminCom(int $id)
    {
        return \App\Admin::find($id);
    }
}
