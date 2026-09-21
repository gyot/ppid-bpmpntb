<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class UserController extends Controller
{
    protected function checkSuperAdmin()
    {
        if (auth()->user()->role !== 'super_admin') {
            abort(403, 'Hanya super admin yang dapat mengelola pengguna.');
        }
    }

    public function index(Request $request)
    {
        $this->checkSuperAdmin();
        $query = User::query()->latest();

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%");
            });
        }

        if ($request->filled('role')) {
            $query->where('role', $request->role);
        }

        $users = $query->paginate(15)->withQueryString();

        return view('admin.users.index', compact('users'));
    }

    public function create()
    {
        $this->checkSuperAdmin();
        return view('admin.users.create');
    }

    public function store(Request $request)
    {
        $this->checkSuperAdmin();
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => ['required', 'confirmed', Password::min(8)],
            'role' => 'required|in:super_admin,admin_ppid,petugas,pemohon',
            'phone' => 'nullable|string|max:20',
            'nik' => 'nullable|string|max:16',
            'address' => 'nullable|string|max:500',
        ]);

        try {
            User::create([
                'name' => $validated['name'],
                'email' => $validated['email'],
                'password' => Hash::make($validated['password']),
                'role' => $validated['role'],
                'phone' => $validated['phone'] ?? null,
                'nik' => $validated['nik'] ?? null,
                'address' => $validated['address'] ?? null,
            ]);

            return redirect()->route('admin.users.index')
                ->with('success', 'Pengguna berhasil ditambahkan.');
        } catch (\Exception $e) {
            return back()->withInput()->with('error', 'Gagal menambahkan pengguna: ' . $e->getMessage());
        }
    }

    public function show($id)
    {
        $user = User::findOrFail($id);
        return view('admin.users.show', compact('user'));
    }

    public function edit($id)
    {
        $this->checkSuperAdmin();
        $user = User::findOrFail($id);
        return view('admin.users.edit', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $this->checkSuperAdmin();
        $user = User::findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'password' => ['nullable', 'confirmed', Password::min(8)],
            'role' => 'required|in:super_admin,admin_ppid,petugas,pemohon',
            'phone' => 'nullable|string|max:20',
            'nik' => 'nullable|string|max:16',
            'address' => 'nullable|string|max:500',
        ]);

        try {
            $data = [
                'name' => $validated['name'],
                'email' => $validated['email'],
                'role' => $validated['role'],
                'phone' => $validated['phone'] ?? null,
                'nik' => $validated['nik'] ?? null,
                'address' => $validated['address'] ?? null,
            ];

            if (!empty($validated['password'])) {
                $data['password'] = Hash::make($validated['password']);
            }

            $user->update($data);

            return redirect()->route('admin.users.index')
                ->with('success', 'Pengguna berhasil diperbarui.');
        } catch (\Exception $e) {
            return back()->withInput()->with('error', 'Gagal memperbarui pengguna: ' . $e->getMessage());
        }
    }

    public function destroy($id)
    {
        $this->checkSuperAdmin();
        try {
            if (auth()->id() == $id) {
                return back()->with('error', 'Anda tidak dapat menghapus akun sendiri.');
            }

            $user = User::findOrFail($id);
            $user->delete();

            return redirect()->route('admin.users.index')
                ->with('success', 'Pengguna berhasil dihapus.');
        } catch (\Exception $e) {
            return back()->with('error', 'Gagal menghapus pengguna: ' . $e->getMessage());
        }
    }
}
