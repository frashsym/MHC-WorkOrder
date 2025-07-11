<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 1; $i <= 10; $i++) {
            DB::table('orders')->insert([
                'department_id' => rand(1, 3),
                'category_id' => rand(1, 3),
                'item_id' => rand(1, 3),
                'pic_id' => rand(1, 3),
                'reporter' => rand(1, 2),
                'title' => 'Order Title ' . $i,
                'description' => 'This is the description for order #' . $i,
                'date' => now()->toDateString(),
                'time' => now()->toTimeString(),
                'progress_id' => rand(1, 3),
                'priority_id' => rand(1, 3),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
