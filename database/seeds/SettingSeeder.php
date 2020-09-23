<?php
/***
Author: Moshiur Rahman Tonmoy
Facebook: https://www.facebook.com/mmrtonmoy
GitHub: https://www.github.com/mmrtonmoybd
About: I am a php, laravel, codeigniter developer.
***/
use Illuminate\Database\Seeder;
use App\Setting;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Setting::create([
        'name' => 'app_name',
        'value' => 'Moshiur Ecommerce',
        ]);
        
        Setting::create([
        'name' => 'app_url',
        'value' => 'http://127.0.0.1:8000',
        ]);
        
        Setting::create([
        'name' => 'app_env',
        'value' => 'local',
        ]);
        
        Setting::create([
        'name' => 'app_debug',
        'value' => 'false',
        ]);
        
        Setting::create([
        'name' => 'app_timezone',
        'value' => 'Asia/Dhaka',
        ]);
        
        Setting::create([
        'name' => 'stripe_secret',
        'value' => 'sk_test_jjgjfmkvmjvjvcmckkfkcnkfkfkc',
        ]);
        
        Setting::create([
        'name' => 'stripe_public',
        'value' => 'sk_test_jjgjfmkvmjvjvcmckkfkcnkfkfkc',
        ]);
        
        Setting::create([
        'name' => 'item_per_page',
        'value' => 12,
        ]);
        
        Setting::create([
        'name' => 'item_per_column',
        'value' => 6,
        ]);
        
        Setting::create([
        'name' => 'vat',
        'value' => 5,
        ]);
        
        Setting::create([
        'name' => 'register',
        'value' => 1,
        ]);
        
        Setting::create([
        'name' => 'checkout',
        'value' => 1,
        ]);
    }
}