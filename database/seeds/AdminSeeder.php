<?php

use Illuminate\Database\Seeder;
use App\Admin;
use Faker\Factory as Faker; 
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $fake = Faker::create();
        $user = new Admin();
		$user->name = $fake->name;
		$user->email = 'moshiur@admin.com';
		$user->password = Hash::make('12345678');
		$user->email_verified_at = Carbon::now()->toDateTimeString();
		$user->save();
    }
}