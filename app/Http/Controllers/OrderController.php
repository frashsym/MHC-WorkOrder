<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
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
            'object',
            'pic',
            'reporter',
            'progress',
            'priority'
        ])->paginate(10);

        return view('orders.orders', compact('orders'));
    }
}
