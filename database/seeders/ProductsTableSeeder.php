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
        $data = [];

        for ($i = 1; $i <= 10; $i++) {
            $data[] = [
                'title' => 'Product ' . $i,
                'slug' => 'product-' . $i,
                'sku' => 'SKU-' . $i,
                'category_id' => rand(1, 10),
                'sub_category_id' => rand(1, 10),
                'brand_id' => rand(1, 10),
                'old_price' => rand(1000, 10000000000),
                'price' => rand(1000, 10000000000),
                'short_description' => 'Short description for Product ' . $i,
                'description' => 'Full description for Product ' . $i,
                'additional_information' => 'Additional information for Product ' . $i,
                'shipping_returns' => 'Shipping and returns information for Product ' . $i,
                'status' => 0,
                'is_delete' => 0,
                'created_by' => rand(1, 20),
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        DB::table('products')->insert($data);
    }
}
