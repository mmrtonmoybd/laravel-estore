<?php
/*
Author: Moshiur Rahman Tonmoy
Facebook: https://www.facebook.com/mmrtonmoy
GitHub: https://www.github.com/mmrtonmoybd
About: I am a php, laravel, codeigniter developer.
*/

namespace App\Http\Controllers;

use App\Traits\ProductShow;

/**
 * @internal
 * @coversNothing
 */
class Test extends Controller
{
    use ProductShow;

    public function test()
    {
        dd($this->getMostSellProduct());
    }
}
