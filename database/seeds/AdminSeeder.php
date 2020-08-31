<?php

use Illuminate\Database\Seeder;
use App\Admin;
use Faker\Factory as Faker; 
use Illuminate\Support\Facades\Hash;
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
        $admin->email = $fake->email;
        $admin->password = Hash::make('123456@@');
        $admin->save();
    }
}