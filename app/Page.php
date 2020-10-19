<?php
/*
Author: Moshiur Rahman Tonmoy
Facebook: https://www.facebook.com/mmrtonmoy
GitHub: https://www.github.com/mmrtonmoybd
About: I am a php, laravel, codeigniter developer.
*/

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\HtmlString;
use League\CommonMark\CommonMarkConverter;
use League\CommonMark\Environment;
use League\CommonMark\Extension\Table\TableExtension;

class Page extends Model
{
    protected $fillable = ['title', 'content'];

    public static function getParse($value)
    {
        $environment = Environment::createCommonMarkEnvironment();

        $environment->addExtension(new TableExtension());

        $converter = new CommonMarkConverter([
            'allow_unsafe_links' => false,
            'html_input' => 'escape',
        ], $environment);

        return new HtmlString($converter->convertToHtml($value));
    }
}
