<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Order;
use App\Models\Department;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

        if (Auth::user()->role_id === 4) {
            // role_id = 4 → khusus engineering saja
            $departments = Department::where('id', 2)->get();
        } elseif (Auth::user()->role_id === 1) {
            // SuperAdmin → selalu lihat semua departemen
            $departments = Department::all();
        } else {
            // user lain → cuma lihat yang visible
            $departments = Department::where('is_visible', true)->get();
        }

        // Hanya department yang visible yang dipakai untuk chart
        $visibleDepartments = $departments->where('is_visible', true);

        $chartData = [];

        foreach ($visibleDepartments as $department) {
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

        return view('dashboard', compact(
            'departments',     // <── tambahin ini biar nggak undefined
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

    public function toggleVisibility(Request $request, Department $department)
    {
        // hanya SuperAdmin yang boleh
        if (Auth::user()->role_id !== 1) {
            abort(403, 'Unauthorized');
        }

        $department->update([
            'is_visible' => !$department->is_visible
        ]);

        return response()->json([
            'success' => true,
            'is_visible' => $department->is_visible,
            'message' => $department->is_visible ? 'Department ditampilkan' : 'Department disembunyikan'
        ]);
    }
}
