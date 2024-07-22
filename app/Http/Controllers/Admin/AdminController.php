<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Gate;

class AdminController extends Controller
{
    public function index()
    {
        $admins = User::where('is_admin', 1)->get();

        return view('admin.admin.index', compact('admins'));
    }

    public function create()
    {
        return view('admin.admin.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'avatar' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'is_admin' => 'required|boolean',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $admin = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'is_admin' => $request->input('is_admin', 1), // Gunakan input dari request atau default 1
            'account_status' => 'Terverifikasi'
        ]);

        if ($request->hasFile('avatar')) {
            $avatarPath = $request->file('avatar')->store('public/avatars');
            $admin->avatar = basename($avatarPath);
            $admin->save();
        }

        return redirect()->route('admin.admin.index')->with([
            'message' => 'Data admin baru telah ditambahkan!',
            'alert-type' => 'success'
        ]);
    }

    public function edit($id)
    {
        $admin = User::findOrFail($id);

        if (Gate::denies('view', $admin)) {
            return redirect()->route('admin.admin.index')->with([
                'message' => 'Anda tidak memiliki izin untuk mengakses halaman ini.',
                'alert-type' => 'error'
            ]);
        }

        return view('admin.admin.edit', compact('admin'));
    }

    public function update(Request $request, $id)
    {
        $admin = User::findOrFail($id);

        if (Gate::denies('update', $admin)) {
            return redirect()->route('admin.admin.index')->with([
                'message' => 'Anda tidak memiliki izin untuk mengakses halaman ini.',
                'alert-type' => 'error'
            ]);
        }

        $request->validate([
            'avatar' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $admin->id,
        ]);

        if ($request->hasFile('avatar')) {
            if ($admin->avatar) {
                Storage::delete('public/avatars/' . $admin->avatar);
            }
            $avatarPath = $request->file('avatar')->store('public/avatars');
            $admin->avatar = basename($avatarPath);
        }

        $admin->update($request->all());

        return redirect()->route('admin.admin.index')->with([
            'message' => 'Data admin telah diperbarui!',
            'alert-type' => 'success'
        ]);
    }
    public function updateAvatar(Request $request)
    {
        $request->validate([
            'avatar' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $admin = Auth::user();

        // Delete old avatar if it exists
        if ($admin->avatar) {
            Storage::delete('public/avatars/' . $admin->avatar);
        }

        // Store new avatar
        $avatarPath = $request->file('avatar')->store('public/avatars');
        $admin->avatar = basename($avatarPath);
        $admin->save();

        return response()->json(['success' => true]);
    }


    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $admin = Auth::user();

        if (!Hash::check($request->current_password, $admin->password)) {
            return back()->withErrors(['current_password' => 'Password saat ini salah']);
        }

        $admin->password = Hash::make($request->password);
        $admin->save();

        return redirect()->back()->with([
            'message' => 'Password akun diperbarui!',
            'alert-type' => 'success'
        ]);
        
    }
}
