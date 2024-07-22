<?php

namespace App\Http\Controllers\Admin;

use App\Models\Setting;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\SettingRequest;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class SettingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $setting = Setting::first();

        if (!is_null($setting)) {
            return view('admin.settings.edit', compact('setting'));
        }

        return view('admin.settings.create');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.settings.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SettingRequest $request)
    {
        Setting::create($request->validated());

        return redirect()->route('admin.settings.index')->with([
            'message' => 'Data setting berhasil di tambah!',
            'alert-type' => 'success'
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Setting $setting)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Setting $setting)
    {
        return view('admin.settings.edit', compact('setting'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(SettingRequest $request, Setting $setting)
    {
        if ($request->validated()) {
            if ($request->hasFile('logo')) {
                // Hapus logo yang ada jika ada
                if ($setting->logo) {
                    Storage::disk('public')->delete($setting->logo);
                }

                // Simpan logo yang baru
                $logo = $request->file('logo')->store('frontend/img/logo', 'public');
                $setting->update($request->except('logo') + ['logo' => $logo]);
            } else {
                $setting->update($request->validated());
            }
        }

        return redirect()->route('admin.settings.index')->with([
            'message' => 'Data setting berhasil diupdate!',
            'alert-type' => 'success'
        ]);
    }


    public function updateLogo(Request $request)
    {
        $request->validate([
            'logo' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $setting = Setting::first(); // Mengambil setting yang pertama atau Anda bisa menyesuaikan sesuai logika Anda

        if ($request->hasFile('logo')) {
            if ($setting->logo) {
                File::delete('storage/' . $setting->logo);
            }
            $logoPath = $request->file('logo')->store('frontend/img/logo', 'public');
            $setting->logo = $logoPath;
            $setting->save();
        }

        return response()->json(['success' => true]);
    }


    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Setting $setting)
    {
        $setting->delete();

        return redirect()->back()->with([
            'message' => 'Data setting berhasil di hapus!',
            'alert-type' => 'success'
        ]);
    }
}
