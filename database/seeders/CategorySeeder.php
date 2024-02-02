<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            'running',
            'casual',
            'outdoor'
        ];

        foreach ($categories as $category) {
            $index = array_search($category, $categories);
            DB::table('categories')->insert([
                'id' => $index + 1,
                'name' => $category,
            ]);
        }
    }
}