<?php

namespace App\Http\Controllers\Admin;

use App\Models\Booking;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;

class BookingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

        $status = $request->input('status');

        if ($status) {
            $bookings = Booking::where('booking_status', $status)
            ->orderByDesc('created_at')
            ->get();
        } else {
            $bookings = Booking::orderByDesc('created_at')->get();
        }

        return view('admin.bookings.index', compact('bookings'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Booking $booking)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Booking $booking)
    {
        //

        return view('admin.bookings.edit', compact('booking'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Booking $booking)
    {
        //
        $validatedData = $request->validate([
            'booking_status' => 'required',
        ]);

        $booking->update($validatedData);

        return redirect()->route('admin.bookings.index')->with([
            'message' => 'Data booking berhasil di update!',
            'alert-type' => 'success'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Booking $booking)
    {
        $booking->delete();

        return redirect()->back()->with([
            'message' => 'Data booking berhasil di hapus!',
            'alert-type' => 'danger'
        ]);
    }

    // public function generatePdf()
    // {
    //     // $bookings = Booking::with(['user', 'vehicle'])->get();
    //     $bookings = Booking::all();
    //     $pdf = PDF::loadView('admin.bookings.pdf', compact('bookings'));
    //     return $pdf->stream('data-sewa.pdf');
    // }

    public function generatePdf(Request $request)
    {
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        // Query data sesuai rentang waktu yang dipilih
        $bookings = Booking::whereBetween('start_date', [$startDate, $endDate])
            ->orWhereBetween('end_date', [$startDate, $endDate])
            ->get();

        $current_time = Carbon::now('Asia/Jakarta');

        $formattedDate = $current_time->format('d-m-Y H:i:s');

        // Load view dan kirim data ke dalam PDF
        $pdf = PDF::loadView('admin.bookings.pdf', compact('bookings', 'startDate', 'endDate', 'formattedDate'));
        return $pdf->stream('data-sewa.pdf');
    }
}
