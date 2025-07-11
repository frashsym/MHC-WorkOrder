<?php

namespace App\Http\Controllers;

use App\Models\Priority;
use Illuminate\Http\Request;

class PriorityController extends Controller
{
    public function index()
    {
        $priorities = Priority::latest()->paginate(10);
        return view('priority.priority', compact('priorities'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'priority' => 'required|string|max:255',
        ]);

        Priority::create($request->only('priority'));

        return redirect()->route('priority.index')->with('success', 'Prioritas berhasil ditambahkan.');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'priority' => 'required|string|max:255',
        ]);

        $priority = Priority::findOrFail($id);
        $priority->update($request->only('priority'));

        return redirect()->route('priority.index')->with('success', 'Prioritas berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $priority = Priority::findOrFail($id);
        $priority->delete();

        return redirect()->route('priority.index')->with('success', 'Prioritas berhasil dihapus.');
    }
}
