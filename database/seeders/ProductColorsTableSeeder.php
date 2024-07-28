<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductColorsTableSeeder extends Seeder
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
                'color_id' => rand(1, 10),
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('product_colors')->insert($data);
    }
}
