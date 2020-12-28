<?php
/*
Author: Moshiur Rahman Tonmoy
Facebook: https://www.facebook.com/mmrtonmoy
GitHub: https://www.github.com/mmrtonmoybd
About: I am a php, laravel, codeigniter developer.
*/

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\App;

class HtmlMifier
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $response = $next($request);

        $contentType = $response->headers->get('Content-Type');
        if (false !== strpos($contentType, 'text/html')) {
            $response->setContent($this->minify($response->getContent()));
        }

        return $response;
    }

    public function minify($input)
    {
        $search = [
            '/\>\s+/s',
            '/\s+</s',
        ];

        $replace = [
            '> ',
            ' <',
        ];

        if (App::environment(['local', 'staging'])) {
            return $input;
        }
        return preg_replace($search, $replace, $input);
    }
}
