<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Car;
use App\Models\Motorcycle;

class SearchController extends Controller
{
    //
    public function cari(Request $request)
    {
        $kendaraan = $request->input('kendaraan');
        $parameters = $request->except('kendaraan');

        if ($kendaraan === 'Mobil') {
            return redirect()->route('car.index', $parameters);
        } elseif ($kendaraan === 'Motor') {
            return redirect()->route('moto.index', $parameters);
        } else {
            return redirect()->back()->with('error', 'Jenis kendaraan tidak valid');
        }
    }

    public function daftarMobil(Request $request)
    {
        $kategori = $request->input('category_id');
        $harga = $request->input('harga');
        $penumpang = $request->input('penumpang');

        $hargaRange = explode('-', $harga);
        $hargaMin = isset($hargaRange[0]) ? (int)$hargaRange[0] : null;
        $hargaMax = isset($hargaRange[1]) ? (int)$hargaRange[1] : null;

        $query = Car::query();

        if ($kategori) {
            $query->where('category_id', $kategori);
        }
        if ($hargaMin !== null && $hargaMax !== null) {
            $query->whereBetween('harga', [$hargaMin, $hargaMax]);
        }
        if ($penumpang) {
            $query->where('penumpang', $penumpang);
        }

        $mobils = $query->get();

        return view('daftar-mobil', compact('mobils'));
    }

    public function daftarMotor(Request $request)
    {
        $kategori = $request->input('category_id');
        $harga = $request->input('harga');

        $hargaRange = explode('-', $harga);
        $hargaMin = isset($hargaRange[0]) ? (int)$hargaRange[0] : null;
        $hargaMax = isset($hargaRange[1]) ? (int)$hargaRange[1] : null;

        $query = Motorcycle::query();

        if ($kategori) {
            $query->where('category_id', $kategori);
        }
        if ($hargaMin !== null && $hargaMax !== null) {
            $query->whereBetween('harga', [$hargaMin, $hargaMax]);
        }

        $motors = $query->get();

        return view('daftar-motor', compact('motors'));
    }
}
