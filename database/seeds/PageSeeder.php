<?php
/*
Author: Moshiur Rahman Tonmoy
Facebook: https://www.facebook.com/mmrtonmoy
GitHub: https://www.github.com/mmrtonmoybd
About: I am a php, laravel, codeigniter developer.
*/
use App\Page;
use Illuminate\Database\Seeder;

class PageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        Page::create([
            'title' => 'About Us',
            'content' => 'A simple about page',
        ]);

        Page::create([
            'title' => 'Contact Us',
            'content' => 'A simple contact us page',
        ]);

        Page::create([
            'title' => 'Privacy Policy',
            'content' => 'A simple Policy page',
        ]);

        Page::create([
            'title' => 'Tram Of Services',
            'content' => 'A simple tram page',
        ]);
    }
}
