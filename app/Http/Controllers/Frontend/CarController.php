<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Car;
use App\Models\Booking;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Frontend\BookingRequest;
use App\Models\Feedback;
use App\Models\Type;

class CarController extends Controller
{
    public function index(Request $request)
    {
        $query = Car::query();

        if ($request->has('harga')) {
            $hargaRange = explode('-', $request->harga);
            $query->whereBetween('price', [$hargaRange[0], $hargaRange[1]]);
        }

        if ($request->has('category_id')) {
            $query->where('type_id', $request->category_id);
        }

        if ($request->has('penumpang')) {
            $query->where('penumpang', $request->penumpang);
        }

        $cars = $query->get();
        $availability = [];

        foreach ($cars as $car) {
            if ($request->has('start_date') && $request->has('end_date')) {
                $startDate = $request->start_date;
                $endDate = $request->end_date;

                $isAvailable = $car->rentals()->where(function ($query) use ($startDate, $endDate) {
                    $query->whereBetween('start_date', [$startDate, $endDate])
                        ->orWhereBetween('end_date', [$startDate, $endDate])
                        ->orWhereRaw('? BETWEEN start_date AND end_date', [$startDate])
                        ->orWhereRaw('? BETWEEN start_date AND end_date', [$endDate]);
                })->doesntExist();

                $availability[$car->id] = $isAvailable;
            } else {
                $availability[$car->id] = true; // Default to true if no dates are selected
            }
        }

        $types = Type::select('nama')->distinct()->get();

        return view('frontend.car.index', compact('cars', 'availability', 'types'));
    }

    public function show($id)
    {
        $cars = Car::findorFail($id);
        $feedbacks = Feedback::where('vehicle_type', 'car')->where('vehicle_id', $id)->get();
        return view('frontend.car.show', compact('cars', 'feedbacks'));
    }

    public function store(BookingRequest $request)
    {
        Booking::create($request->validated());

        return redirect()->back()->with([
            'message' => 'kami akan menghubungi anda secepatnya !',
            'alert-type' => 'success'
        ]);
    }
}
