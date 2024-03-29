<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run()
    {
        $this->call(AdminSeeder::class);
        $this->call(CategorieSeeder::class);
        $this->call(ProductSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(UserInfoSeeder::class);
        $this->call(AdminInfoSeeder::class);
        $this->call(SettingSeeder::class);
        $this->call(PageSeeder::class);


    }
}
