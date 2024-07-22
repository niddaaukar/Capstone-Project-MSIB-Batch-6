<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Feedback;
use App\Http\Requests\Frontend\FeedbackRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class FeedbackController extends Controller
{
    public function store(FeedbackRequest $request)
    {
        $user = Auth::user();
        // Validasi input
        $validated = $request->validated();

        // Debugging
        Log::info('Feedback received: ', $validated);

        // Simpan feedback ke dalam database
        Feedback::create($validated);

        // Mendapatkan nilai booking_code, vehicle_type, dan vehicle_id
        $avatar = $request->input('avatar');
        $bookingCode = $request->input('booking_code');
        $vehicleType = $request->input('vehicle_type');
        $vehicleId = $request->input('vehicle_id');

        // Simpan feedback ke dalam database


        // Redirect ke halaman lain atau tampilkan pesan sukses
        return redirect()->route('booking_confirmation', [
            'booking_code' => $bookingCode,
            'vehicle_type' => $vehicleType,
            'vehicle_id' => $vehicleId
        ])->with([
            'message' => 'Berhasil memberikan Feedback.',
            'alert-type' => 'success'
        ]);
    }

}
