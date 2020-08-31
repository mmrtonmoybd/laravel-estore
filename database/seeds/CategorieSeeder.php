<?php

use Illuminate\Database\Seeder;
use App\Categorie;

class CategorieSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $category = new Categorie();
        $category->name = "T-Shirt";
        $category->description = "Men's T-Shirt. Only for Men."; 
        $category->products = 7;
        $category->save();
    }
}