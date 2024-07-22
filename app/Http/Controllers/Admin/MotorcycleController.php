<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Motorcycle;
use App\Models\TypeMotorcycle;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
class MotorcycleController extends Controller
{
    public function index()
    {
        $motorcycles = Motorcycle::get();
        return view('admin.motorcycles.index', compact('motorcycles'));
    }

    public function create()
    {
        $statuses = Motorcycle::statuses();
        $types = TypeMotorcycle::get(['id', 'nama']);
        return view('admin.motorcycles.create', compact('statuses', 'types'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_motor' => 'required|string|max:255',
            'plat_nomor' => 'required|string|max:10',
            'type_id' => 'required|integer',
            'price' => 'required|numeric',
            'image1' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'image2' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'image3' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'image4' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'description' => 'nullable|string',
            'status' => 'required|integer',
        ]);

        $motorcycle = new Motorcycle();
        $motorcycle->nama_motor = $request->nama_motor;
        $motorcycle->plat_nomor = $request->plat_nomor;
        $motorcycle->type_id = $request->type_id;
        $motorcycle->price = $request->price;
        $motorcycle->slug = Str::slug($request->nama_motor, '-');

        if ($request->hasFile('image1')) {
            $motorcycle->image1 = $request->file('image1')->store('motorcycles/images', 'public');
        }
        if ($request->hasFile('image2')) {
            $motorcycle->image2 = $request->file('image2')->store('motorcycles/images', 'public');
        }
        if ($request->hasFile('image3')) {
            $motorcycle->image3 = $request->file('image3')->store('motorcycles/images', 'public');
        }
        if ($request->hasFile('image4')) {
            $motorcycle->image4 = $request->file('image4')->store('motorcycles/images', 'public');
        }

        $motorcycle->description = $request->description;
        $motorcycle->status = $request->status;
        $motorcycle->save();

        return redirect()->route('admin.motorcycles.index')->with([
            'message' => 'Data motor berhasil di tambah!',
            'alert-type' => 'success'
        ]);
    }

    public function show($id)
    {
        $motorcycle = Motorcycle::findOrFail($id);
        return view('admin.motorcycles.show', compact('motorcycle'));
    }

    public function edit(Motorcycle $motorcycle)
    {
        $statuses = Motorcycle::statuses();
        $types = TypeMotorcycle::get(['id', 'nama']);
        return view('admin.motorcycles.edit', compact('motorcycle', 'types', 'statuses'));
    }

    public function update(Request $request, Motorcycle $motorcycle)
    {
        $request->validate([
            'nama_motor' => 'required|string|max:255',
            'plat_nomor' => 'required|string|max:10',
            'type_id' => 'required|integer',
            'price' => 'required|numeric',
            'image1' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'image2' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'image3' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'image4' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'description' => 'nullable|string',
            'status' => 'required|integer',
        ]);

        $motorcycle->nama_motor = $request->nama_motor;
        $motorcycle->plat_nomor = $request->plat_nomor;
        $motorcycle->type_id = $request->type_id;
        $motorcycle->price = $request->price;
        $motorcycle->slug = Str::slug($request->nama_motor, '-');

        if ($request->hasFile('image1')) {
            if ($motorcycle->image1) {
                Storage::disk('public')->delete($motorcycle->image1);
            }
            $motorcycle->image1 = $request->file('image1')->store('motorcycles/images', 'public');
        }
        if ($request->hasFile('image2')) {
            if ($motorcycle->image2) {
                Storage::disk('public')->delete($motorcycle->image2);
            }
            $motorcycle->image2 = $request->file('image2')->store('motorcycles/images', 'public');
        }
        if ($request->hasFile('image3')) {
            if ($motorcycle->image3) {
                Storage::disk('public')->delete($motorcycle->image3);
            }
            $motorcycle->image3 = $request->file('image3')->store('motorcycles/images', 'public');
        }
        if ($request->hasFile('image4')) {
            if ($motorcycle->image4) {
                Storage::disk('public')->delete($motorcycle->image4);
            }
            $motorcycle->image4 = $request->file('image4')->store('motorcycles/images', 'public');
        }

        $motorcycle->description = $request->description;
        $motorcycle->status = $request->status;
        $motorcycle->save();

        return redirect()->route('admin.motorcycles.index')->with([
            'message' => 'Data motor berhasil diperbarui!',
            'alert-type' => 'success'
        ]);
    }
    public function editImage($id, $image)
    {
        $motorcycle = Motorcycle::findOrFail($id);
        return view('admin.motorcycles.edit_image', compact('motorcycle', 'image'));
    }

    public function updateImage(Request $request, $id, $image)
    {
        $request->validate([
            $image => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $motorcycle = Motorcycle::findOrFail($id);

        if ($request->hasFile($image)) {
            if ($motorcycle->$image) {
                Storage::disk('public')->delete($motorcycle->$image);
            }
            $motorcycle->$image = $request->file($image)->store('motorcycles/images', 'public');
        }

        $motorcycle->save();

        return redirect()->route('admin.motorcycles.edit', $motorcycle)->with([
            'message' => 'Data motor berhasil diperbarui!',
            'alert-type' => 'success'
        ]);
    }

    public function destroy(Motorcycle $motorcycle)
    {
        if ($motorcycle->image1) {
            Storage::disk('public')->delete($motorcycle->image1);
        }
        if ($motorcycle->image2) {
            Storage::disk('public')->delete($motorcycle->image2);
        }
        if ($motorcycle->image3) {
            Storage::disk('public')->delete($motorcycle->image3);
        }
        if ($motorcycle->image4) {
            Storage::disk('public')->delete($motorcycle->image4);
        }

        $motorcycle->delete();

        return redirect()->back()->with([
            'message' => 'Data motor berhasil di hapus!',
            'alert-type' => 'success'
        ]);
    }
}
