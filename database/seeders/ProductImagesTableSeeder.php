<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductImagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $images = [];
        for ($i = 0; $i < 50; $i++) {
            $images[] = [
                'product_id' => fake()->numberBetween(1, 100), // Replace with your actual product IDs
                'variant_id' => fake()->numberBetween(1, 10), // Replace with your actual variant IDs
                'pendingProcess' => fake()->numberBetween(0, 1),
                'mainImage' => fake()->boolean(70), // 70% chance of being main image
                'image' => fake()->imageUrl(),
                'imageSequence' => fake()->numberBetween(1, 5),
                'status' => fake()->randomElement(['active', 'inactive']),
                'fullUrl' => fake()->url,
            ];
        }

        // Insert data into the 'product_images' table
        DB::table('images')->insert($images);
    }
}
