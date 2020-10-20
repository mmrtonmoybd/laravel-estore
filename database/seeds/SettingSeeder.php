<?php
/*
Author: Moshiur Rahman Tonmoy
Facebook: https://www.facebook.com/mmrtonmoy
GitHub: https://www.github.com/mmrtonmoybd
About: I am a php, laravel, codeigniter developer.
*/
use App\Setting;
use Illuminate\Database\Seeder;

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
            'name' => 'currency',
            'value' => 'USD',
        ]);

        Setting::create([
            'name' => 'home_title',
            'value' => 'Moshiur Ecommerce',
        ]);

        Setting::create([
            'name' => 'home_info',
            'value' => 'home description',
        ]);

        Setting::create([
            'name' => 'home_image',
            'value' => 'home.jpg',
        ]);

        Setting::create([
            'name' => 'currency_icon',
            'value' => '$',
        ]);
    }
}
