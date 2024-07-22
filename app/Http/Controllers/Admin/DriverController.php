<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Driver;

class DriverController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $driver = Driver::find($id);
        return view('admin.drivers.index' , [
            'drivers' => Driver::get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        Driver::create($request->validated());

        return redirect()->route('admin.drivers.index')->with([
            'message' => 'Data biaya driver berhasil di tambah!',
            'alert-type' => 'success'
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'biaya_driver' => 'required|numeric',
        ]);

        Driver::create($request->validated());

        return redirect()->route('admin.drivers.index')->with([
            'message' => 'Data biaya driver berhasil di tambah!',
            'alert-type' => 'success'
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        //
        $driver = Driver::find($id);
        return view('admin.drivers.index', compact('driver'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $driver = Driver::findOrFail($id); // Mengambil data driver berdasarkan ID
        return view('drivers.edit', compact('driver')); // Mengirim data ke view
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // Validasi data yang diterima
        $validatedData = $request->validate([
            'biaya_driver' => 'required|numeric'
        ]);

        // Mengambil data driver berdasarkan ID
        $driver = Driver::findOrFail($id);

        // Mengupdate data driver menggunakan data yang telah divalidasi
        $driver->update($validatedData);

        // Redirect atau kembalikan respons sesuai kebutuhan Anda
        return redirect()->route('admin.drivers.index')->with([
            'message' => 'Data biaya driver berhasil diupdate!',
            'alert-type' => 'success'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {

    }
}
