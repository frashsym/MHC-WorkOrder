<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 1; $i <= 10; $i++) {
            $now = now();
            $progressId = rand(1, 5); // Not Started - Finished
            $startedAt = null;
            $pausedAt = null;
            $totalDuration = 0;

            // Simulasi waktu sesuai progress
            if ($progressId == 3) { // On Progress
                $startedAt = $now->copy()->subHours(rand(1, 3));
            } elseif ($progressId == 4) { // Hold
                $startedAt = $now->copy()->subHours(rand(2, 4));
                $pausedAt = $now->copy()->subMinutes(rand(10, 60));
            } elseif ($progressId == 5) { // Finished
                $startedAt = $now->copy()->subHours(rand(1, 5));
                $totalDuration = rand(1800, 7200); // durasi antara 30 menit – 2 jam
            }

            DB::table('orders')->insert([
                'title' => 'Order Title ' . $i,
                'letter_number' => 'ORD-' . str_pad($i, 5, '0', STR_PAD_LEFT),
                'department_id' => rand(1, 3),
                'category_id' => rand(1, 3),
                'item_id' => rand(1, 3),
                'pic' => rand(1, 3),
                'reporter' => rand(1, 3),
                'description' => 'This is the description for order #' . $i,
                'create_date' => $now->toDateString(),
                'create_time' => $now->toTimeString(),
                'progress_id' => $progressId,
                'priority_id' => rand(1, 3),
                'started_at' => $startedAt,
                'paused_at' => $pausedAt,
                'total_duration' => $totalDuration,
                'created_at' => $now,
                'updated_at' => $now,
            ]);
        }
    }
}
