<?php
/***
Author: Moshiur Rahman Tonmoy
Facebook: https://www.facebook.com/mmrtonmoy
GitHub: https://www.github.com/mmrtonmoybd
About: I am a php, laravel, codeigniter developer.
***/
namespace App;

use Actuallymab\LaravelComment\Models\Comment as LaravelComment;

class Comment extends LaravelComment
{
    protected $with = ['comments'];
}