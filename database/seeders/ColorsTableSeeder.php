<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ColorsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $colors = [];

        for ($i = 1; $i <= 10; $i++) {
            $colors[] = [
                'name' => 'Color ' . $i,
                'code' => '#' . strtoupper(dechex(rand(0x000000, 0xFFFFFF))),
                'created_by' => rand(1, 5),
                'status' => 0,
                'is_delete' => 0,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        DB::table('colors')->insert($colors);
    }
}
