<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        $startDate = Carbon::create(2025, 7, 1);
        $endDate = Carbon::create(2025, 8, 31);
        $totalOrders = 200;
        $maxPerDate = 10; // max order per tanggal (ubah jika perlu)

        // Ambil data referensi dari DB supaya ID selalu sesuai
        $allUserIds = DB::table('users')->pluck('id')->toArray();
        $usersByDept = [];
        $departments = DB::table('users')->select('department_id')->distinct()->pluck('department_id')->toArray();
        foreach ($departments as $deptId) {
            $usersByDept[$deptId] = DB::table('users')
                ->where('department_id', $deptId)
                ->pluck('id')
                ->toArray();
        }

        // Ambil kategori & item per department
        $categoriesByDept = [];
        $cats = DB::table('categories')->select('id', 'department_id')->get();
        foreach ($cats as $c) {
            $categoriesByDept[$c->department_id][] = $c->id;
        }

        $itemsByDept = [];
        $items = DB::table('items')->select('id', 'department_id')->get();
        foreach ($items as $it) {
            $itemsByDept[$it->department_id][] = $it->id;
        }

        // Penampung berapa order per tanggal (key = Y-m-d)
        $datesUsed = [];

        // Perhitungan hari range
        $daysRange = $startDate->diffInDays($endDate);

        for ($i = 1; $i <= $totalOrders; $i++) {
            // Pilih tanggal acak dalam range, pastikan batas per-hari
            $tries = 0;
            do {
                $offset = rand(0, $daysRange);
                $randomDate = $startDate->copy()->addDays($offset);
                $dateKey = $randomDate->toDateString();
                $tries++;
                // fallback jika loop terlalu lama (safety)
                if ($tries > 200) {
                    // kalau sudah penuh, pakai startDate sebagai fallback
                    $randomDate = $startDate->copy();
                    $dateKey = $randomDate->toDateString();
                    break;
                }
            } while (($datesUsed[$dateKey] ?? 0) >= $maxPerDate);

            // catat penggunaan tanggal
            $datesUsed[$dateKey] = ($datesUsed[$dateKey] ?? 0) + 1;

            // acak jam kerja 08:00 - 17:59
            $hour = rand(8, 17);
            $minute = rand(0, 59);
            $createdAt = $randomDate->copy()->setTime($hour, $minute, 0);

            // Pilih department (1..3) — hanya department yang ada di DB
            $departmentIds = array_values(array_unique(array_keys($categoriesByDept)));
            if (empty($departmentIds)) {
                // jika belum ada categories (tidak ideal), default 1..3
                $departmentIds = [1, 2, 3];
            }
            $departmentId = $departmentIds[array_rand($departmentIds)];

            // Ambil category & item yang sesuai department, fallback jika kosong
            $availableCategories = $categoriesByDept[$departmentId] ?? [];
            $availableItems = $itemsByDept[$departmentId] ?? [];

            if (empty($availableCategories)) {
                // fallback ke kategori random dari DB
                $availableCategories = DB::table('categories')->pluck('id')->toArray();
            }
            if (empty($availableItems)) {
                $availableItems = DB::table('items')->pluck('id')->toArray();
            }

            $categoryId = $availableCategories[array_rand($availableCategories)];
            $itemId = $availableItems[array_rand($availableItems)];

            // Pilih pic: user dari department yang sama, tapi exclude id 1 (admin)
            $picCandidates = $usersByDept[$departmentId] ?? [];
            // exclude admin id = 1
            $picCandidates = array_values(array_filter($picCandidates, function ($id) {
                return $id != 1;
            }));

            if (empty($picCandidates)) {
                // fallback: semua user kecuali admin
                $picCandidates = array_values(array_filter($allUserIds, function ($id) {
                    return $id != 1;
                }));
            }

            // Ambil reporter: bisa siapa saja (termasuk admin = 1)
            $reporterId = $allUserIds[array_rand($allUserIds)];

            $pic = $picCandidates[array_rand($picCandidates)];

            // Progress dan simulasi waktu
            $progressId = rand(1, 6); // ikut range sebelumnya
            $startedAt = null;
            $pausedAt = null;
            $totalDuration = 0;

            if ($progressId == 3) {
                // sedangkan progress 3: sudah mulai beberapa jam sebelum created_at
                $startedAt = $createdAt->copy()->subHours(rand(1, 3));
            } elseif ($progressId == 4) {
                // progress 4: ada started & paused
                $startedAt = $createdAt->copy()->subHours(rand(2, 4));
                // paused beberapa menit sebelum created_at
                $pausedAt = $createdAt->copy()->subMinutes(rand(10, 60));
            } elseif ($progressId == 5) {
                // selesai/selesai parsial: total_duration antara 30m - 2h
                $startedAt = $createdAt->copy()->subHours(rand(1, 5));
                $totalDuration = rand(1800, 7200); // detik
            }

            DB::table('orders')->insert([
                'title' => 'Order Title ' . $i,
                'letter_number' => 'ORD-' . str_pad($i, 5, '0', STR_PAD_LEFT),
                'department_id' => $departmentId,
                'category_id' => $categoryId,
                'item_id' => $itemId,
                'pic' => $pic,
                'reporter' => $reporterId,
                'description' => $faker->sentence(8),
                'create_date' => $createdAt->toDateString(),
                'create_time' => $createdAt->toTimeString(),
                'progress_id' => $progressId,
                'priority_id' => rand(1, 4),
                'started_at' => $startedAt,
                'paused_at' => $pausedAt,
                'total_duration' => $totalDuration,
                'created_at' => $createdAt,
                'updated_at' => $createdAt,
            ]);
        }
    }
}
