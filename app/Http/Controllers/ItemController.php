<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Department;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    public function index()
    {
        $items = Item::with('department')->latest()->paginate(10);
        $departments = Department::all();

        return view('item.item', compact('items', 'departments'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'department_id' => 'required|exists:departments,id',
        ]);

        Item::create($request->only('name', 'department_id'));

        return redirect()->route('item.index')->with('success', 'Objek berhasil ditambahkan!');
    }

    public function update(Request $request, Item $item)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'department_id' => 'required|exists:departments,id',
        ]);

        $item->update($request->only('name', 'department_id'));

        return redirect()->route('item.index')->with('success', 'Objek berhasil diperbarui!');
    }

    public function destroy(Item $item)
    {
        $item->delete();

        return redirect()->route('item.index')->with('success', 'Objek berhasil dihapus!');
    }
}
