<?php
/***
Author: Moshiur Rahman Tonmoy
Facebook: https://www.facebook.com/mmrtonmoy
GitHub: https://www.github.com/mmrtonmoybd
About: I am a php, laravel, codeigniter developer.
***/
use Illuminate\Database\Seeder;
use App\UserInfo;
use Faker\Factory as Faker;

class UserInfoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
		$fake = Faker::create();
        $userinfo = new UserInfo();
		$userinfo->address = $fake->address;
		$userinfo->mobile = $fake->e164PhoneNumber;
		$userinfo->ip = '127.0.0.1';
		$userinfo->user_id = 1;
		$userinfo->save();
    }
}
