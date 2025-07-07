<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Department;
use App\Models\Category;
use App\Models\Progress;
use App\Models\Priority;
use App\Models\Device;
use App\Models\Order;
use App\Models\User;
use App\Models\Pic;

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
            'object',
            'pic',
            'reporter',
            'progress',
            'priority'
        ])->paginate(10);

        $departments = Department::all();
        $categories = Category::all();
        $objects = Device::all();
        $pics = Pic::all();
        $users = User::all();
        $progresses = Progress::all();
        $priorities = Priority::all();

        return view('orders.orders', compact(
            'orders',
            'departments',
            'categories',
            'objects',
            'pics',
            'users',
            'progresses',
            'priorities'
        ));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'object_id' => 'required|exists:devices,id',
            'department_id' => 'required|exists:departments,id',
            'category_id' => 'required|exists:categories,id',
            'progress_id' => 'required|exists:progresses,id',
            'priority_id' => 'required|exists:priorities,id',
            'date' => 'required|date',
            'time' => 'required',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $fileName = null;
        if ($request->hasFile('photo')) {
            $file = $request->file('photo');
            $extension = $file->getClientOriginalExtension();
            $fileName = time() . '_' . pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME) . '.' . $extension;
            $file->move(public_path('images/orders'), $fileName);
        }

        $order = Order::create([
            'title' => $request->title,
            'description' => $request->description,
            'object_id' => $request->object_id,
            'department_id' => $request->department_id,
            'category_id' => $request->category_id,
            'progress_id' => $request->progress_id,
            'priority_id' => $request->priority_id,
            'date' => $request->date,
            'time' => $request->time,
            'reporter' => auth()->id(),
            'photo' => $fileName,
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
}
