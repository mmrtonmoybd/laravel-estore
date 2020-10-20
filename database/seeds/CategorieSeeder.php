<?php

use App\Categorie;
use Illuminate\Database\Seeder;

class CategorieSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $category = new Categorie();
        $category->name = 'T-Shirt';
        $category->description = "Men's T-Shirt. Only for Men.";
        $category->products = 7;
        $category->save();
    }
}
