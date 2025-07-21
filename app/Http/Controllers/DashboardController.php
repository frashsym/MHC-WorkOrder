<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Order;
use App\Models\Department;

class DashboardController extends Controller
{
    public function index()
    {
        // Atur locale Indonesia untuk Carbon
        Carbon::setLocale('id');

        $today = Carbon::today();
        $startOfMonth = $today->copy()->startOfMonth();

        // Ambil semua departemen
        $departments = Department::all();

        // Siapkan data grafik per departemen
        $chartData = [];

        foreach ($departments as $department) {
            $dailyCounts = [];

            // Iterasi dari tanggal 1 sampai hari ini
            for ($date = $startOfMonth->copy(); $date->lte($today); $date->addDay()) {
                $count = Order::whereDate('created_at', $date)
                    ->where('department_id', $department->id)
                    ->count();

                $dailyCounts[] = $count;
            }

            $chartData[] = [
                'label' => $department->name,
                'data' => $dailyCounts
            ];
        }

        // Label X axis & tooltip
        $labels = [];      // hanya tanggal: 1, 2, 3, ...
        $rawLabels = [];   // lengkap: 22 Juli 2025, ...

        for ($date = $startOfMonth->copy(); $date->lte($today); $date->addDay()) {
            $labels[] = $date->format('j'); // "1", "2", ..., hari ini
            $rawLabels[] = $date->translatedFormat('d F Y'); // e.g. "22 Juli 2025"
        }

        return view('dashboard', compact('chartData', 'labels', 'rawLabels'));
    }
}
