<?php
/***
Author: Moshiur Rahman Tonmoy
Facebook: https://www.facebook.com/mmrtonmoy
GitHub: https://www.github.com/mmrtonmoybd
About: I am a php, laravel, codeigniter developer.
***/
use Illuminate\Database\Seeder;
use App\User;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
		$fake = Faker::create();
        $user = new User();
		$user->name = $fake->name;
		$user->email = 'moshiur@user.com';
		$user->password = Hash::make('12345678');
		$user->email_verified_at = Carbon::now()->toDateTimeString();
		$user->save();
    }
}