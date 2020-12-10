<?php
/*
Author: Moshiur Rahman Tonmoy
Facebook: https://www.facebook.com/mmrtonmoy
GitHub: https://www.github.com/mmrtonmoybd
About: I am a php, laravel, codeigniter developer.
*/

namespace Database\Seeders;

use App\Models\AdminInfo;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;

class AdminInfoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $fake = Faker::create();
        $adminInfo = new AdminInfo();
        $adminInfo->address = $fake->address;
        $adminInfo->mobile = $fake->e164PhoneNumber;
        $adminInfo->ip = '127.0.0.1';
        $adminInfo->admin_id = 1;
        $adminInfo->save();
    }
}
