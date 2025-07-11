<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    public function index()
    {
        $roles = Role::latest()->paginate(10);
        return view('role.role', compact('roles'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'role' => 'required|string|max:255',
        ]);

        Role::create($request->only('role'));

        return redirect()->route('role.index')->with('success', 'Role berhasil ditambahkan.');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'role' => 'required|string|max:255',
        ]);

        $role = Role::findOrFail($id);
        $role->update($request->only('role'));

        return redirect()->route('role.index')->with('success', 'Role berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $role = Role::findOrFail($id);
        $role->delete();

        return redirect()->route('role.index')->with('success', 'Role berhasil dihapus.');
    }
}
