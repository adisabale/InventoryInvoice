<?php

namespace Database\Seeders;
use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
       $products = [
           [
            'product_name'        => 'Sugar',
            'product_price'       => 40,
            'product_description' => 'Sugar'
           ],
           [
            'product_name'        => 'Salt',
            'product_price'       => 20,
            'product_description' => 'Salt'
           ],
           [
            'product_name'        => 'Walnuts',
            'product_price'       => 140,
            'product_description' => 'Walnuts'
           ],
           [
            'product_name'        => 'Almonds',
            'product_price'       => 240,
            'product_description' => 'Almonds'
           ],
           [
            'product_name'        => 'Sunflower oil',
            'product_price'       => 120,
            'product_description' => 'Sunflower oil'
           ],
           [
            'product_name'        => 'Pepper',
            'product_price'       => 60,
            'product_description' => 'Pepper'
           ],
           [
            'product_name'        => 'Cheese',
            'product_price'       => 200,
            'product_description' => 'Cheese'
           ],
           [
            'product_name'        => 'Oats',
            'product_price'       => 160,
            'product_description' => 'Oats'
           ],
           [
            'product_name'        => 'Carrots',
            'product_price'       => 30,
            'product_description' => 'Carrots'
           ],
           [
            'product_name'        => 'Tomatoes',
            'product_price'       => 20,
            'product_description' => 'Tomatoes'
           ],
           [
            'product_name'        => 'Broccoli',
            'product_price'       => 60,
            'product_description' => 'Broccoli'
           ]
        ];
    Product::insert($products);
    }
}
