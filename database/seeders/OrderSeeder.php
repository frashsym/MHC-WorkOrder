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
                'department_id' => 1,
                'category_id' => 1,
                'item_id' => 1,
                'pic_id' => 1,
                'reporter' => 1,
                'title' => 'Order Title ' . $i,
                'description' => 'This is the description for order #' . $i,
                'date' => now()->toDateString(),
                'time' => now()->toTimeString(),
                'progress_id' => 1,
                'priority_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
