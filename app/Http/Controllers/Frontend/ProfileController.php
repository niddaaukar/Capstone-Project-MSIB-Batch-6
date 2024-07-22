<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Feedback;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        return view('frontend.profile.index', compact('user'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'phone' => 'required|string|max:15',
            'address' => 'required|string|max:255',
            'ktp' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
            'sim' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
        ]);

        $user = Auth::user();
        $previousStatus = $user->account_status;

        $isAvatarUpdated = false;
        $isOtherFieldUpdated = false;

        if ($request->hasFile('avatar')) {
            if ($user->avatar) {
                Storage::delete('public/avatars/' . $user->avatar);
            }
            $avatarPath = $request->file('avatar')->store('public/avatars');
            $user->avatar = basename($avatarPath);
            $isAvatarUpdated = true;
        }

        // Update phone and address
        $user->phone = $request->phone;
        $user->address = $request->address;

        // Handle KTP file upload
        if ($request->hasFile('ktp')) {
            $ktp = $request->file('ktp');
            $ktpPath = $ktp->store('public/ktp');
            if ($user->ktp) {
                Storage::delete('public/ktp/' . $user->ktp);
            }
            $user->ktp = basename($ktpPath);
            $isOtherFieldUpdated = true;
        }

        // Handle SIM file upload
        if ($request->hasFile('sim')) {
            $sim = $request->file('sim');
            $simPath = $sim->store('public/sim');
            if ($user->sim) {
                Storage::delete('public/sim/' . $user->sim);
            }
            $user->sim = basename($simPath);
            $isOtherFieldUpdated = true;
        }

        if ($user->phone !== $request->phone) {
            $user->phone = $request->phone;
            $isOtherFieldUpdated = true;
        }

        if ($user->address !== $request->address) {
            $user->address = $request->address;
            $isOtherFieldUpdated = true;
        }

        // Update account status to "Menunggu Verifikasi" if other fields are updated
        if ($isOtherFieldUpdated) {
            $user->account_status = 'Menunggu Verifikasi';
        }

        $user->save();

        Feedback::where('user_id', $user->id)->update(['avatar' => $user->avatar]);

        return redirect()->back()->with([
            'message' => 'Akun anda telah diperbarui!',
            'alert-type' => 'success'
        ])->with('user', $user);
    }


    public function updateAvatar(Request $request)
    {
        $request->validate([
            'avatar' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $user = Auth::user();

        // Handle avatar file upload
        if ($request->hasFile('avatar')) {
            $avatar = $request->file('avatar');
            $avatarPath = $avatar->store('public/avatars');
            if ($user->avatar) {
                Storage::delete('public/avatars/' . $user->avatar);
            }
            $user->avatar = basename($avatarPath);
            $user->save();

            Feedback::where('user_id', $user->id)->update(['avatar' => $user->avatar]);
        }

        return response()->json(['success' => true]);
    }


    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $user = Auth::user();

        // Check current password
        if (!Hash::check($request->current_password, $user->password)) {
            return back()->withErrors(['current_password' => 'Password saat ini salah']);
        }

        // Update password
        $user->password = Hash::make($request->password);
        $user->save();

        return redirect()->back()->with([
            'message' => 'Password akun diperbarui!',
            'alert-type' => 'success'
        ]);
    }
}
