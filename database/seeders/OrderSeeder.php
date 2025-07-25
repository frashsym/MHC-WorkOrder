<?php

namespace Database\Seeders;

use Illuminate\Support\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = \Faker\Factory::create();
        $datesUsed = []; // untuk melacak jumlah order tiap tanggal
        $maxDate = 25;   // batasi hanya sampai 25 Juli 2025
        $totalOrders = 100;

        for ($i = 1; $i <= $totalOrders; $i++) {
            // Pilih tanggal antara 1 - 25 Juli 2025
            do {
                $randomDay = rand(1, $maxDate);
                $dateKey = str_pad($randomDay, 2, '0', STR_PAD_LEFT);
            } while (($datesUsed[$dateKey] ?? 0) >= 10); // maksimal 10 per tanggal

            // Simpan penggunaan tanggal
            $datesUsed[$dateKey] = ($datesUsed[$dateKey] ?? 0) + 1;

            $randomDate = Carbon::create(2025, 7, $randomDay);
            $randomTime = Carbon::createFromTime(rand(8, 17), rand(0, 59), 0); // jam kerja

            $createdAt = $randomDate->copy()->setTimeFrom($randomTime);

            $progressId = rand(1, 5);
            $startedAt = null;
            $pausedAt = null;
            $totalDuration = 0;

            // Simulasi waktu sesuai progress
            if ($progressId == 3) {
                $startedAt = $createdAt->copy()->subHours(rand(1, 3));
            } elseif ($progressId == 4) {
                $startedAt = $createdAt->copy()->subHours(rand(2, 4));
                $pausedAt = $createdAt->copy()->subMinutes(rand(10, 60));
            } elseif ($progressId == 5) {
                $startedAt = $createdAt->copy()->subHours(rand(1, 5));
                $totalDuration = rand(1800, 7200); // 30m - 2h
            }

            DB::table('orders')->insert([
                'title' => 'Order Title ' . $i,
                'letter_number' => 'ORD-' . str_pad($i, 5, '0', STR_PAD_LEFT),
                'department_id' => rand(1, 3), // IT, Engineering, Markom
                'category_id' => rand(1, 3),
                'item_id' => rand(1, 3),
                'pic' => rand(1, 3),
                'reporter' => rand(1, 3),
                'description' => 'This is the description for order #' . $i,
                'create_date' => $createdAt->toDateString(),
                'create_time' => $createdAt->toTimeString(),
                'progress_id' => $progressId,
                'priority_id' => rand(1, 3),
                'started_at' => $startedAt,
                'paused_at' => $pausedAt,
                'total_duration' => $totalDuration,
                'created_at' => $createdAt,
                'updated_at' => $createdAt,
            ]);
        }
    }
}
