<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Order;
use App\Models\Department;

class DashboardController extends Controller
{
    public function index()
    {
        Carbon::setLocale('id');

        $selectedMonth = request()->get('month', Carbon::now()->month);
        $selectedYear = request()->get('year', Carbon::now()->year);

        $startOfMonth = Carbon::createFromDate($selectedYear, $selectedMonth, 1)->startOfMonth();
        $endOfMonth = $startOfMonth->copy()->endOfMonth();
        $today = Carbon::today();

        // Jika bulan/tahun saat ini, batas sampai hari ini. Jika bulan lampau, sampai akhir bulan.
        $lastDay = ($startOfMonth->isSameMonth($today)) ? $today : $endOfMonth;

        $departments = Department::all();
        $chartData = [];

        foreach ($departments as $department) {
            $dailyCounts = [];

            for ($date = $startOfMonth->copy(); $date->lte($lastDay); $date->addDay()) {
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

        $labels = [];
        $rawLabels = [];

        for ($date = $startOfMonth->copy(); $date->lte($lastDay); $date->addDay()) {
            $labels[] = $date->format('j');
            $rawLabels[] = $date->translatedFormat('d F Y');
        }

        // Untuk default value di view
        return view('dashboard', compact(
            'chartData',
            'labels',
            'rawLabels',
            'selectedMonth',
            'selectedYear'
        ));
    }

    public function getOrdersByDateAndDepartment()
    {
        $date = request('date');
        $department = request('department');

        $orders = Order::with(['department', 'category', 'picUser'])
            ->whereDate('created_at', $date)
            ->whereHas('department', function ($q) use ($department) {
                $q->where('name', $department);
            })
            ->get();

        return view('partials.orders-table', compact('orders'))->render(); // kirim potongan view
    }

}
