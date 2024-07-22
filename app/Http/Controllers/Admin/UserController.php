<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;

class UserController extends Controller
{
    public function index()
    {
        $users = User::where('is_admin', 0)->get();

        return view('admin.users.index', compact('users'));
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('admin.users.edit', compact('user'));
    }


    public function update(User $user, Request $request)
    {
        $user->update($request->all());

        return redirect()->route('admin.users.index')->with([
            'message' => 'Data User berhasil di update!',
            'alert-type' => 'success'
        ]);
    }

    public function destroy(User $user)
    {
        $user->delete();

        return redirect()->route('admin.users.index')->with([
            'message' => 'Data User berhasil di hapus!',
            'alert-type' => 'success'
        ]);
    }
}
