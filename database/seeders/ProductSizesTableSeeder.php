<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSizesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [];

        for ($i = 1; $i <= 10; $i++) {
            $data[] = [
                'product_id' => rand(1, 20),
                'name' => 'Name ' . $i,
                'price' => rand(1000, 10000000000),
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('product_sizes')->insert($data);
    }
}
