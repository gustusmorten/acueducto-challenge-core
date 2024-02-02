<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        foreach (range(1, 200) as $index) {
            DB::table('products')->insert([
                'brand' => $faker->company,
                'description' => $faker->text,
                'image' => $faker->imageUrl,
                'name' => $faker->words(2, true),
                'price' => $faker->randomFloat(2, 1, 1000),
                'stock' => $faker->numberBetween(10, 100),
                'category_id' => $faker->numberBetween(1, 3),
            ]);
        }
    }
}