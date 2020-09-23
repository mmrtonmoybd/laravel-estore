<?php
/***
Author: Moshiur Rahman Tonmoy
Facebook: https://www.facebook.com/mmrtonmoy
GitHub: https://www.github.com/mmrtonmoybd
About: I am a php, laravel, codeigniter developer.
***/
use Illuminate\Database\Seeder;
use App\AdminInfo;
use Faker\Factory as Faker;

class AdminInfoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
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