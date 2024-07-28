<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Faker\Factory as Faker;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();
        $data = [];
        for ($i = 1; $i <= 10; $i++) {
            $data[] = [
                'name' => 'Name ' . $i,
                'email' => $faker->unique()->safeEmail,
                'email_verified_at' => now(),
                'password' => Hash::make($faker->password),
                'remember_token' => Str::random(10),
                'is_admin' => 0,
                'status' => 0,             
                'is_delete' => 0,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('users')->insert($data);
    }
}
