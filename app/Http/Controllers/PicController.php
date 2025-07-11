<?php

namespace App\Http\Controllers;

use App\Models\Pic;
use App\Models\Department;
use Illuminate\Http\Request;

class PicController extends Controller
{
    public function index()
    {
        $pics = Pic::with('department')->latest()->paginate(10);
        $departments = Department::all();
        return view('pic.pic', compact('pics', 'departments'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'department_id' => 'required|exists:departments,id',
        ]);

        Pic::create($request->only('name', 'department_id'));

        return redirect()->route('pic.index')->with('success', 'PIC berhasil ditambahkan.');
    }

    public function update(Request $request, Pic $pic)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'department_id' => 'required|exists:departments,id',
        ]);

        $pic->update($request->only('name', 'department_id'));

        return redirect()->route('pic.index')->with('success', 'PIC berhasil diperbarui.');
    }

    public function destroy(Pic $pic)
    {
        $pic->delete();

        return redirect()->route('pic.index')->with('success', 'PIC berhasil dihapus.');
    }
}
