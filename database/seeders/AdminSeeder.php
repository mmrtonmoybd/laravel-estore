<?php
namespace Database\Seeders;

use App\Models\Admin;
use Carbon\Carbon;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
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
