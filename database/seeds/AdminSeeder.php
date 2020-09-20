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
        $admin = new Admin();
		$admin->name = $fake->name;
		$admin->email = 'moshiur@admin.com';
		$admin->password = Hash::make('12345678');
		$admin->isAdmin = 1;
		$admin->email_verified_at = Carbon::now()->toDateTimeString();
		$admin->save();
    }
}