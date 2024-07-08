<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
       

        $products = [];
        for ($i = 0; $i < 100; $i++) {
            $products[] = [
                'product_name'=>fake()->name(),
                'category_id' => fake()->numberBetween(1, 10),
                'pendingProcess' => fake()->numberBetween(0, 1),
                'status' => fake()->numberBetween(0, 1),
                'sku' => fake()->unique()->ean8,
                'barcode' => fake()->ean13,
                'stock_on_hand' => fake()->numberBetween(0, 1000),
                'compare_price' => fake()->randomFloat(2, 10, 100),
                'selling_price' => fake()->randomFloat(2, 5, 90),
                'image' => fake()->imageUrl(),
                'description' => fake()->paragraph,
                'weight' => fake()->randomFloat(2, 0.1, 50),
                'weightUnit' => fake()->randomElement(['kilogram', 'gram', 'ounce']),
                'PushedDate' => fake()->date(),
                'retriveDate' => fake()->date(),
            ];
        }

        // Insert data into the 'products' table
        DB::table('products')->insert($products);
    }
}
