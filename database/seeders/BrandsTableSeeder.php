<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BrandsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $brands = [];

        for ($i = 1; $i <= 10; $i++) {
            $brands[] = [
                'name' => 'Brand ' . $i,
                'slug' => 'brand-' . $i,
                'meta_title' => 'Example Meta Title ' . $i,
                'meta_description' => 'Example Meta Description ' . $i,
                'meta_keywords' => 'keyword' . $i . ', keyword' . ($i + 1),
                'created_by' => rand(1, 5),
                'status' => 0,
                'is_delete' => 0,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        DB::table('brands')->insert($brands);
    }
}
