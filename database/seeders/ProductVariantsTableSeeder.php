<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductVariantsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $variants = [];
        for ($i = 0; $i < 100; $i++) {
            $variants[] = [
                'product_id' => fake()->numberBetween(1, 5), // Replace with your actual product IDs
                'image_id' => fake()->numberBetween(1, 5), // You can adjust this based on your application logic
                'variant_name' => fake()->words(2, true),
                'pendingProcess' => fake()->numberBetween(0, 1),
                'status' => fake()->numberBetween(0, 1),
                'sku' => fake()->unique()->ean8,
                'barcode' => fake()->ean13,
                'color' => fake()->safeColorName,
                'size' => fake()->randomElement(['Small', 'Medium', 'Large']),
                'option1' => fake()->word,
                'option2' => fake()->word,
                'stock_in_hand' => fake()->numberBetween(0, 100),
                'weight' => fake()->randomFloat(2, 0.1, 50),
                'weightUnit' => fake()->randomElement(['kilogram', 'gram', 'ounce']),
                'compare_price' => fake()->randomFloat(2, 10, 100),
                'selling_price' => fake()->randomFloat(2, 5, 90),
                'PushedDate' => fake()->date(),
                'retriveDate' => fake()->date(),
            ];
        }

        // Insert data into the 'products_variants' table
        DB::table('variants')->insert($variants);
    }
}
