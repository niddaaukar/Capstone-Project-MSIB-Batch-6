<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Car;
use App\Models\Type;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
class CarController extends Controller
{
    public function index()
    {
        $car = Car::get();
        return view('admin.cars.index', compact('car'));
    }

    public function create()
    {
        $statuses = Car::statuses();
        $types = Type::get(['id', 'nama']);
        return view('admin.cars.create', compact('statuses', 'types'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_mobil' => 'required|string|max:255',
            'plat_nomor' => 'required|string|max:10',
            'type_id' => 'required|integer',
            'price' => 'required|numeric',
            'penumpang' => 'required|integer',
            'pintu' => 'required|integer',
            'image1' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'image2' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'image3' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'image4' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'description' => 'nullable|string',
            'status' => 'required|integer',
        ]);

        $car = new Car();
        $car->nama_mobil = $request->nama_mobil;
        $car->plat_nomor = $request->plat_nomor;
        $car->type_id = $request->type_id;
        $car->price = $request->price;
        $car->penumpang = $request->penumpang;
        $car->pintu= $request->pintu;
        $car->slug = Str::slug($request->nama_mobil, '-');

        if ($request->hasFile('image1')) {
            $car->image1 = $request->file('image1')->store('cars/images', 'public');
        }
        if ($request->hasFile('image2')) {
            $car->image2 = $request->file('image2')->store('cars/images', 'public');
        }
        if ($request->hasFile('image3')) {
            $car->image3 = $request->file('image3')->store('cars/images', 'public');
        }
        if ($request->hasFile('image4')) {
            $car->image4 = $request->file('image4')->store('cars/images', 'public');
        }

        $car->description = $request->description;
        $car->status = $request->status;
        $car->save();

        return redirect()->route('admin.cars.index')->with([
            'message' => 'Data mobil berhasil ditambahkan!',
            'alert-type' => 'success'
        ]);
    }

    public function show($id)
    {
        $car = Car::findOrFail($id);
        return view('admin.cars.show', compact('car'));
    }

    public function edit(Car $car)
    {
        $statuses = Car::statuses();
        $types = Type::get(['id', 'nama']);
        return view('admin.cars.edit', compact('car', 'types', 'statuses'));
    }

    public function update(Request $request, Car $car)
    {
        $request->validate([
            'nama_mobil' => 'required|string|max:255',
            'plat_nomor' => 'required|string|max:10',
            'type_id' => 'required|integer',
            'price' => 'required|numeric',
            'penumpang' => 'required|integer',
            'pintu' => 'required|integer',
            'image1' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'image2' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'image3' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'image4' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'description' => 'nullable|string',
            'status' => 'required|integer',
        ]);

        $car->nama_mobil = $request->nama_mobil;
        $car->plat_nomor = $request->plat_nomor;
        $car->type_id = $request->type_id;
        $car->price = $request->price;
        $car->pintu= $request->pintu;
        $car->penumpang = $request->penumpang;
        $car->slug = Str::slug($request->nama_mobil, '-');

        if ($request->hasFile('image1')) {
            if ($car->image1) {
                Storage::disk('public')->delete($car->image1);
            }
            $car->image1 = $request->file('image1')->store('cars/images', 'public');
        }
        if ($request->hasFile('image2')) {
            if ($car->image2) {
                Storage::disk('public')->delete($car->image2);
            }
            $car->image2 = $request->file('image2')->store('cars/images', 'public');
        }
        if ($request->hasFile('image3')) {
            if ($car->image3) {
                Storage::disk('public')->delete($car->image3);
            }
            $car->image3 = $request->file('image3')->store('cars/images', 'public');
        }
        if ($request->hasFile('image4')) {
            if ($car->image4) {
                Storage::disk('public')->delete($car->image4);
            }
            $car->image4 = $request->file('image4')->store('cars/images', 'public');
        }

        $car->description = $request->description;
        $car->status = $request->status;
        $car->save();

        return redirect()->route('admin.cars.index')->with([
            'message' => 'Data mobil berhasil diperbarui!',
            'alert-type' => 'success'
        ]);
    }
    public function editImage($id, $image)
    {
        $car = Car::findOrFail($id);
        return view('admin.cars.edit_image', compact('car', 'image'));
    }

    public function updateImage(Request $request, $id, $image)
    {
        $request->validate([
            $image => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $car = Car::findOrFail($id);

        if ($request->hasFile($image)) {
            if ($car->$image) {
                Storage::disk('public')->delete($car->$image);
            }
            $car->$image = $request->file($image)->store('cars/images', 'public');
        }

        $car->save();

        return redirect()->route('admin.cars.edit', $car)->with([
            'message' => 'Gambar mobil berhasil diperbarui!',
            'alert-type' => 'success'
        ]);
    }

    public function destroy(Car $car)
    {
        if ($car->image1) {
            Storage::disk('public')->delete($car->image1);
        }
        if ($car->image2) {
            Storage::disk('public')->delete($car->image2);
        }
        if ($car->image3) {
            Storage::disk('public')->delete($car->image3);
        }
        if ($car->image4) {
            Storage::disk('public')->delete($car->image4);
        }

        $car->delete();

        return redirect()->back()->with([
            'message' => 'Data mobil berhasil di hapus!',
            'alert-type' => 'success'
        ]);
    }
}
