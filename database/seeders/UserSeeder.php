<?php
/*
Author: Moshiur Rahman Tonmoy
Facebook: https://www.facebook.com/mmrtonmoy
GitHub: https://www.github.com/mmrtonmoybd
About: I am a php, laravel, codeigniter developer.
*/

namespace Database\Seeders;
use App\Models\User;
use Carbon\Carbon;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
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
