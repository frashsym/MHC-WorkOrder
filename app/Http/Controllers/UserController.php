<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Role;
use App\Models\Department;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $users = User::with('role')->latest()->paginate(10);
        $roles = Role::all();
        $departments = Department::all();

        return view('user.user', compact('users', 'roles', 'departments'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users',
            'role_id' => 'required|exists:roles,id',
            'email' => 'required|email|unique:users',
            'department_id' => 'required|exists:departments,id',
            'password' => 'required|string|min:6|confirmed',
        ]);

        User::create([
            'name' => $request->name,
            'username' => $request->username,
            'role_id' => $request->role_id,
            'email' => $request->email,
            'department_id' => $request->department_id,
            'password' => bcrypt($request->password),
        ]);

        return redirect()->route('user.index')->with('success', 'User berhasil ditambahkan!');
    }

    public function update(Request $request, User $user)
    {
        $rules = [
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255',
            'email' => 'required|email',
            'role_id' => 'required|exists:roles,id',
            'department_id' => 'required|exists:departments,id',
        ];

        // Validasi password hanya jika diisi
        if ($request->filled('password')) {
            $rules['password'] = 'nullable|min:6';
        }

        $validated = $request->validate($rules);

        $data = $request->only('name', 'username', 'email', 'role_id', 'department_id');

        if ($request->filled('password')) {
            $data['password'] = bcrypt($request->password);
        }

        $user->update($data);

        return redirect()->route('user.index')->with('success', 'User berhasil diperbarui!');
    }


    public function destroy(User $user)
    {
        $user->delete();

        return redirect()->route('user.index')->with('success', 'User berhasil dihapus!');
    }
}
