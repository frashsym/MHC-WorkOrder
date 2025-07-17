<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Department;
use App\Models\Category;
use App\Models\Progress;
use App\Models\Priority;
use App\Models\Item;
use App\Models\Order;
use App\Models\User;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $orders = Order::with([
            'department',
            'category',
            'item',
            'picUser',
            'reporterUser',
            'progress',
            'priority'
        ])->latest()->paginate(10);

        $departments = Department::all();
        $categories = Category::all();
        $items = Item::all();
        $users = User::all();
        $progresses = Progress::all();
        $priorities = Priority::all();

        return view('order.order', compact(
            'orders',
            'departments',
            'categories',
            'items',
            'users',
            'progresses',
            'priorities'
        ));
    }

    public function getDependentData($departmentId)
    {
        $items = Item::where('department_id', $departmentId)->get();
        $categories = Category::where('department_id', $departmentId)->get();

        // Tambahkan filter hanya user dengan role_id = 2 (Admin/PIC)
        $pics = User::where('department_id', $departmentId)
            ->where('role_id', 2) // hanya role Admin
            ->get();

        return response()->json([
            'items' => $items,
            'categories' => $categories,
            'pics' => $pics,
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'item_id' => 'required|exists:items,id',
            'pic' => 'required|exists:users,id',
            'department_id' => 'required|exists:departments,id',
            'category_id' => 'required|exists:categories,id',
            'priority_id' => 'required|exists:priorities,id',
            'reporter' => 'required|exists:users,id',
        ]);

        $order = Order::create([
            'title' => $request->title,
            'description' => $request->description,
            'item_id' => $request->item_id,
            'pic' => $request->pic,
            'department_id' => $request->department_id,
            'category_id' => $request->category_id,
            'progress_id' => 1,
            'priority_id' => $request->priority_id,
            'reporter' => $request->reporter,
            'create_date' => now()->toDateString(),
            'create_time' => now()->toTimeString(),
            'total_duration' => 0,
        ]);

        if ($request->wantsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Order berhasil dibuat.',
                'data' => $order,
            ], 201);
        }

        return redirect()->route('order.index')->with('success', 'Order berhasil ditambahkan!');
    }

    public function show(Order $order)
    {
        $order->load([
            'department',
            'category',
            'item',
            'picUser',
            'reporterUser',
            'progress',
            'priority'
        ]);

        // Ambil total_duration awal
        $totalSeconds = $order->total_duration;

        // Tambahkan waktu berjalan jika status saat ini "On Progress"
        if ($order->progress_id == 3 && $order->resume_at) {
            $now = now();
            $elapsed = \Carbon\Carbon::parse($order->resume_at)->diffInSeconds($now);
            $totalSeconds += $elapsed;
        }

        // Jika sudah Cancel tapi sebelumnya sedang On Progress
        $isCancelled = $order->progress_id == 6;
        $cancelNote = null;

        if ($isCancelled) {
            if ($order->started_at && $order->resume_at) {
                $now = now();
                $elapsed = \Carbon\Carbon::parse($order->resume_at)->diffInSeconds($now);
                $totalSeconds += $elapsed;
            }
            $cancelNote = "Order ini dibatalkan.";
        }

        // Durasi Berjalan
        $durasiBerjalan = gmdate('H:i:s', $totalSeconds);

        // Durasi Hold
        $durasiHold = null;
        if ($order->progress_id == 4 && $order->paused_at) {
            $elapsedHold = \Carbon\Carbon::parse($order->paused_at)->diffInSeconds(now());
            $durasiHold = gmdate('H:i:s', $elapsedHold);
        }

        return view('order.detail', compact('order', 'durasiBerjalan', 'durasiHold', 'cancelNote'));
    }

    public function update(Request $request, Order $order)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'item_id' => 'required|exists:items,id',
            'pic' => 'required|exists:users,id',
            'department_id' => 'required|exists:departments,id',
            'category_id' => 'required|exists:categories,id',
            'progress_id' => 'required|exists:progresses,id',
            'priority_id' => 'required|exists:priorities,id',
            'reporter' => 'required|exists:users,id',
            'start_date' => 'nullable|date',
            'due_date' => 'nullable|date|after_or_equal:start_date',
        ]);

        $prevProgress = $order->progress_id;
        $newProgress = $request->progress_id;
        $now = now();

        // Logika progres
        if ($prevProgress == 1 && $newProgress == 3) {
            $order->started_at = $now;
            $order->resume_at = $now;
            $order->paused_at = null;
            $order->total_duration = 0;
        } elseif ($prevProgress == 3 && $newProgress == 4) {
            if ($order->resume_at) {
                $elapsed = \Carbon\Carbon::parse($order->resume_at)->diffInSeconds($now);
                $order->total_duration += $elapsed;
            }
            $order->paused_at = $now;
            $order->resume_at = null;
        } elseif ($prevProgress == 4 && $newProgress == 3) {
            $order->resume_at = $now;
            $order->paused_at = null;
        } elseif ($newProgress == 5 || $newProgress == 6) {
            if ($order->resume_at) {
                $elapsed = \Carbon\Carbon::parse($order->resume_at)->diffInSeconds($now);
                $order->total_duration += $elapsed;
            }
            $order->paused_at = null;
            $order->resume_at = null;
        }

        // Set estimasi pengerjaan jika progress_id == 2
        $startDate = null;
        $dueDate = null;

        if ($newProgress == 2) {
            $startDate = $request->start_date;
            $dueDate = $request->due_date;
        }

        // Update kolom lainnya
        $order->update([
            'title' => $request->title,
            'description' => $request->description,
            'item_id' => $request->item_id,
            'pic' => $request->pic,
            'department_id' => $request->department_id,
            'category_id' => $request->category_id,
            'progress_id' => $newProgress,
            'priority_id' => $request->priority_id,
            'reporter' => $request->reporter,
            'started_at' => $order->started_at,
            'paused_at' => $order->paused_at,
            'resume_at' => $order->resume_at,
            'total_duration' => $order->total_duration,
            'start_date' => $startDate,
            'due_date' => $dueDate,
        ]);

        return redirect()->route('order.index')->with('success', 'Order berhasil diperbarui!');
    }

    public function destroy(Order $order)
    {
        $order->delete();

        return redirect()->route('order.index')->with('success', 'Order berhasil dihapus!');
    }
}
