<?php

use Illuminate\Database\Seeder;
use App\Product;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
        [
        "title" => "Orange color T-Shirt",
        "category_id" => 1,
        "discounds" => 0,
        "price" => 10,
        "description" => "It is a Orange color T-Shirt. All size are avilabe",
        "admin_id" => 1,
        "quantity" => 10,
        "image" => "image.jpg"
        ],
        [
        "title" => "Green color T-Shirt",
        "category_id" => 1,
        "discounds" => 10,
        "price" => 5,
        "description" => "It is a Green color T-Shirt. All size are avilabe",
        "admin_id" => 1,
        "quantity" => 5,
        "image" => "image.jpg"
        ],
        [
        "title" => "Blue color T-Shirt",
        "category_id" => 1,
        "discounds" => 5,
        "price" => 6,
        "description" => "It is a Blue color T-Shirt. All size are avilabe",
        "admin_id" => 1,
        "quantity" => 4,
        "image" => "image.jpg"
        ],
        [
        "title" => "Red color T-Shirt",
        "category_id" => 1,
        "discounds" => 0,
        "price" => 8,
        "description" => "It is a Red color T-Shirt. All size are avilabe",
        "admin_id" => 1,
        "quantity" => 10,
        "image" => "image.jpg"
        ],
        [
        "title" => "Black color T-Shirt",
        "category_id" => 1,
        "discounds" => 0,
        "price" => 7,
        "description" => "It is a Black color T-Shirt. All size are avilabe",
        "admin_id" => 1,
        "quantity" => 10,
        "image" => "image.jpg"
        ],
        [
        "title" => "Pink color T-Shirt",
        "category_id" => 1,
        "discounds" => 20,
        "price" => 9,
        "description" => "It is a Pink color T-Shirt. All size are avilabe",
        "admin_id" => 1,
        "quantity" => 10,
        "image" => "image.jpg"
        ]
        ];
        Product::insert($data);
        
    }
}