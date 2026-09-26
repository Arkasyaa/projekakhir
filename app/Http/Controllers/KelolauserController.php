<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class KelolaUserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
    $query = User::where('role', 'user');

    if ($request->filled('search')) {
        $query->where('name', 'like', '%'.$request->search.'%');
    }

    $users = $query->paginate(5);

    return view('pages.admin.kelola_user.index', compact('users'));

    }

    public function create()
    {
        return view('pages.admin.kelola_user.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users,email',
            'password' => 'required|min:8',
            'no_hp'    => 'required|string|max:20',
            'alamat'   => 'required|string',
        ]);

        $validated['password'] = bcrypt($validated['password']);
        $validated['role'] = 'user';

        User::create($validated);

        return redirect()
            ->route('admin.kelola_user.index')
            ->with('success', 'User baru berhasil ditambahkan.');
    }
    
    /**
     * Display the specified resource.
     */
    public function show(User $kelola_user)
    {
        return view('pages.admin.kelola_user.show', ['user' => $kelola_user]);
    }

    public function edit(User $kelola_user)
    {
        return view('pages.admin.kelola_user.edit', ['user' => $kelola_user]);
    }

    public function update(Request $request, User $kelola_user)
    {
        $validated = $request->validate([
            'name'   => 'required|string|max:255',
            'email'  => 'required|email|unique:users,email,' . $kelola_user->id,
            'no_hp'  => 'required|string|max:20',
            'alamat' => 'required|string',
        ]);

        $kelola_user->update($validated);

        return redirect()
            ->route('admin.kelola_user.index')
            ->with('success', 'Data user berhasil diperbarui.');
    }

    public function destroy(User $kelola_user)
    {
        $kelola_user->delete();

        return redirect()
            ->route('admin.kelola_user.index')
            ->with('success', 'User berhasil dihapus.');
    }
}
