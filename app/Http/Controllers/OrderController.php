<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\User;

class OrderController extends Controller
{
    /**
     * Menampilkan daftar tugas (API & Web).
     */
    // public function index()
    // {
    //     $tugas = Order::with('user')->paginate(5);
    //     $users = User::all();

    //     if (request()->wantsJson()) {
    //         return response()->json([
    //             'success' => true,
    //             'data' => $tugas,
    //         ]);
    //     }

    //     return view('tugas.tugas', compact('tugas', 'users'));
    // }
}
 