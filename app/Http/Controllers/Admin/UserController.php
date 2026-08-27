<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $query = User::query();

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhere('phone', 'like', "%{$search}%");
            });
        }

        if ($request->filled('role')) {
            $query->where('role', $request->role);
        }

        if ($request->filled('status')) {
            $query->where('is_active', $request->status === 'active' ? 1 : 0);
        }

        $currentUserId = Auth::id() ?? 0;
        $users = $query->orderByRaw("CASE WHEN id = ? THEN 0 ELSE 1 END, created_at DESC", [$currentUserId])
                       ->paginate(10)
                       ->withQueryString();

        $totalUsers = User::count();
        $totalAdmin = User::where('role', 'admin')->count();
        $totalStaf = User::where('role', 'staf')->count();
        $totalActive = User::where('is_active', true)->count();
        $allPages = User::PAGES;

        return view('admin.users.index', compact('users', 'totalUsers', 'totalAdmin', 'totalStaf', 'totalActive', 'allPages'));
    }

    public function create()
    {
        $allPages = User::PAGES;
        return view('admin.users.create', compact('allPages'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'string', 'min:6'],
            'role' => ['required', 'in:admin,staf'],
            'phone' => ['nullable', 'string', 'max:20'],
            'is_active' => ['nullable', 'boolean'],
            'accessible_pages' => ['nullable', 'array'],
            'accessible_pages.*' => ['string', 'in:' . implode(',', array_keys(User::PAGES))],
        ]);

        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
            'phone' => $request->phone,
            'is_active' => $request->boolean('is_active', true),
            'accessible_pages' => $request->role === 'staf' ? ($request->accessible_pages ?? []) : null,
        ];

        User::create($data);

        return redirect()->route('admin.users.index')
            ->with('success', "Pengguna '{$request->name}' berhasil ditambahkan!");
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        $allPages = User::PAGES;
        return view('admin.users.edit', compact('user', 'allPages'));
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
            'password' => ['nullable', 'string', 'min:6'],
            'role' => ['required', 'in:admin,staf'],
            'phone' => ['nullable', 'string', 'max:20'],
            'is_active' => ['nullable', 'boolean'],
            'accessible_pages' => ['nullable', 'array'],
            'accessible_pages.*' => ['string', 'in:' . implode(',', array_keys(User::PAGES))],
        ]);

        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role,
            'phone' => $request->phone,
            'is_active' => $request->boolean('is_active', true),
            'accessible_pages' => $request->role === 'staf' ? ($request->accessible_pages ?? []) : null,
        ];

        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        if ($user->id === Auth::id() && !$request->boolean('is_active', true)) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Anda tidak dapat menonaktifkan akun yang sedang digunakan saat ini!');
        }

        $user->update($data);

        return redirect()->route('admin.users.index')
            ->with('success', "Data pengguna '{$user->name}' berhasil diperbarui!");
    }

    public function toggleStatus($id)
    {
        $user = User::findOrFail($id);

        if ($user->id === Auth::id()) {
            return redirect()->route('admin.users.index')
                ->with('error', 'Anda tidak dapat mengubah status akun yang sedang aktif digunakan!');
        }

        $user->is_active = !$user->is_active;
        $user->save();

        $statusText = $user->is_active ? 'diaktifkan' : 'dinonaktifkan';

        return redirect()->route('admin.users.index')
            ->with('success', "Akun '{$user->name}' berhasil {$statusText}!");
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);

        if ($user->id === Auth::id()) {
            return redirect()->route('admin.users.index')
                ->with('error', 'Anda tidak dapat menghapus akun Anda sendiri yang sedang aktif!');
        }

        $userName = $user->name;
        $user->delete();

        return redirect()->route('admin.users.index')
            ->with('success', "Pengguna '{$userName}' berhasil dihapus dari sistem!");
    }
}
