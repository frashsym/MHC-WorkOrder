<?php

namespace App\Http\Controllers;

use App\Models\Progress;
use Illuminate\Http\Request;

class ProgressController extends Controller
{
    public function index()
    {
        $progresses = Progress::latest()->paginate(10);
        return view('progress.progress', compact('progresses'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'status' => 'required|string|max:255',
        ]);

        Progress::create($request->only('status'));

        return redirect()->route('progress.index')->with('success', 'Status progress berhasil ditambahkan.');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|string|max:255',
        ]);

        $progress = Progress::findOrFail($id);
        $progress->update($request->only('status'));

        return redirect()->route('progress.index')->with('success', 'Status progress berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $progress = Progress::findOrFail($id);
        $progress->delete();

        return redirect()->route('progress.index')->with('success', 'Status progress berhasil dihapus.');
    }
}
