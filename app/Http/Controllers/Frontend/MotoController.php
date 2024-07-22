<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Motorcycle;
use Illuminate\Http\Request;
use App\Http\Requests\Frontend\BookingRequest;
use App\Models\Booking;
use App\Models\Feedback;
use App\Models\TypeMotorcycle;

class MotoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Motorcycle::query();

        if ($request->has('harga')) {
            $hargaRange = explode('-', $request->harga);
            $query->whereBetween('price', [$hargaRange[0], $hargaRange[1]]);
        }

        if ($request->has('category_id')) {
            $query->where('type_id', $request->category_id);
        }

        $motos = $query->get();
        $availability = [];

        foreach ($motos as $moto) {
            if ($request->has('start_date') && $request->has('end_date')) {
                $startDate = $request->start_date;
                $endDate = $request->end_date;

                $isAvailable = $moto->rentals()->where(function ($query) use ($startDate, $endDate) {
                    $query->whereBetween('start_date', [$startDate, $endDate])
                        ->orWhereBetween('end_date', [$startDate, $endDate])
                        ->orWhereRaw('? BETWEEN start_date AND end_date', [$startDate])
                        ->orWhereRaw('? BETWEEN start_date AND end_date', [$endDate]);
                })->doesntExist();

                $availability[$moto->id] = $isAvailable;
            } else {
                $availability[$moto->id] = true; // Default to true if no dates are selected
            }
        }

        $types = TypeMotorcycle::select('nama')->distinct()->get();

        return view('frontend.moto.index', compact('motos', 'availability', 'types'));
    }

    /**
     * Show the form for creating a new resource.
     */
    
    public function store(BookingRequest $request)
    {
        Booking::create($request->validated());

        return redirect()->back()->with([
            'message' => 'kami akan menghubungi anda secepatnya !',
            'alert-type' => 'success'
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $motos = Motorcycle::findorFail($id);
        $feedbacks = Feedback::where('vehicle_type', 'motorcycle')->where('vehicle_id', $id)->get();
        return view('frontend.moto.show', compact('motos', 'feedbacks'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    
}