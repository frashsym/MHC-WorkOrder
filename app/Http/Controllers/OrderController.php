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
        $pics = User::where('department_id', $departmentId)->get();

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
            'progress_id' => 'required|exists:progresses,id',
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
            'progress_id' => $request->progress_id,
            'priority_id' => $request->priority_id,
            'date' => now()->toDateString(),
            'time' => now()->format('H:i'),
            'reporter' => $request->reporter,
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

        return view('order.detail', compact('order'));
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
        ]);

        $order->update([
            'title' => $request->title,
            'description' => $request->description,
            'item_id' => $request->item_id,
            'pic' => $request->pic,
            'department_id' => $request->department_id,
            'category_id' => $request->category_id,
            'progress_id' => $request->progress_id,
            'priority_id' => $request->priority_id,
            'reporter' => $request->reporter,
        ]);

        return redirect()->route('order.index')->with('success', 'Order berhasil diperbarui!');
    }

    public function destroy(Order $order)
    {
        $order->delete();

        return redirect()->route('order.index')->with('success', 'Order berhasil dihapus!');
    }
}
