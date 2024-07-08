<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Nette\Utils\Random;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [];
        for ($i = 0; $i < 20; $i++) {
            $categories[] = [
                'parent_category_id' => fake()->numberBetween(0, 15), 
                'category_name' => fake()->words(2, true),
                'pendingProcess' => fake()->numberBetween(0, 1),
                'description' => fake()->paragraph,
                'tags' => fake()->words(3, true),
                'slug' => fake()->slug,
                'status' => fake()->boolean(70), 
                'banner' => fake()->imageUrl(800, 400),
                'image' => fake()->imageUrl(400, 300),
                'PushedDate' => fake()->date(),
                'retriveDate' => fake()->date(),
            ];
        }

        // Insert data into the 'categories' table
        DB::table('categories')->insert($categories);
    }
}
