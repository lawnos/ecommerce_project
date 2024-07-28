<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SubCategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [];

        for ($i = 1; $i <= 10; $i++) {
            $data[] = [
                'category_id' => rand(1, 10),
                'name' => 'Name ' . $i,
                'slug' => 'sub-category-' . $i,
                'meta_title' => 'Example Meta Title ' . $i,
                'meta_description' => 'Example Meta Description ' . $i,
                'meta_keywords' => 'keyword' . $i . ', keyword' . ($i + 1),
                'status' => 0,
                'created_by' => rand(1, 20),
                'is_delete' => 0,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        DB::table('sub_categories')->insert($data);
    }
}
