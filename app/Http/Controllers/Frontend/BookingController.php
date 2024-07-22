<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Car;
use App\Models\Motorcycle;
use App\Models\Booking;
use App\Models\Driver;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use App\Models\Feedback;
use App\Models\Cancellation;
use Illuminate\Support\Facades\Gate;
use Carbon\Carbon;

class BookingController extends Controller
{
    public function showAvailabilityForm($vehicle_type, $vehicle_id)
    {
        $user = Auth::user();
        $vehicle = $this->getVehicleByType($vehicle_type, $vehicle_id);
        $isAvailable = false;

        return view('frontend.vehicle.check_availability', compact('vehicle', 'isAvailable', 'vehicle_type', 'user'));
    }

    public function checkVehicleAvailability(Request $request, $vehicle_type, $vehicle_id)
    {
        $user = Auth::user();
    
        // Check if user is verified
        if ($user->account_status !== 'Terverifikasi' && is_null($user->email_verified_at)) {
            return redirect()->back()->with('error', 'Akun harus terverifikasi dan email harus sudah diverifikasi agar bisa sewa!');
        } elseif ($user->account_status !== 'Terverifikasi') {
            return redirect()->back()->with('error', 'Akun harus terverifikasi agar bisa sewa!');
        } elseif (is_null($user->email_verified_at)) {
            return redirect()->back()->with('error', 'Email harus sudah diverifikasi agar bisa sewa!');
        }
    
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');
        $formattedStartDate = Carbon::parse($startDate)->translatedFormat('j F Y');
        $formattedEndDate = Carbon::parse($endDate)->translatedFormat('j F Y');
        $with_driver = $request->input('with_driver', false);
        $pickup = $request->input('pickup', false);
        $vehicle = $this->getVehicleByType($vehicle_type, $vehicle_id);
    
        // Additional date validations
        $today = (new \DateTime('now', new \DateTimeZone('GMT+7')))->format('Y-m-d');
        $maxStartDate = (new \DateTime())->modify('+60 days')->format('Y-m-d');
    
        if ($startDate > $maxStartDate) {
            return redirect()->back()->with('error', 'Maksimal tanggal mulai sewa adalah 60 hari kedepan!');
        }
    
        if ($startDate < $today) {
            return redirect()->back()->with('error', 'Tanggal mulai tidak boleh berada di masa lalu!');
        }
    
        if ($endDate < $startDate) {
            return redirect()->back()->with('error', 'Tanggal selesai tidak boleh sebelum tanggal mulai!');
        }
    
        $startDateTime = new \DateTime($startDate);
        $endDateTime = new \DateTime($endDate);
        $dateInterval = $startDateTime->diff($endDateTime)->days;
        if ($dateInterval > 6) {
            return redirect()->back()->with('error', 'Durasi maksimal sewa adalah 7 hari!');
        }
    
        $isAvailable = Booking::where('vehicle_id', $vehicle_id)
            ->where('vehicle_type', $vehicle_type)
            ->whereNotIn('booking_status', ['Dibatalkan', 'Selesai'])
            ->where(function ($query) use ($startDate, $endDate) {
                $query->whereBetween('start_date', [$startDate, $endDate])
                    ->orWhereBetween('end_date', [$startDate, $endDate])
                    ->orWhereRaw('? BETWEEN start_date AND end_date', [$startDate])
                    ->orWhereRaw('? BETWEEN start_date AND end_date', [$endDate]);
            })->doesntExist();
    
        if (!$isAvailable) {
            return redirect()->back()->with('error', 'Kendaraan tidak tersedia pada tanggal yang dipilih!');
        }
    
        return view('frontend.vehicle.check_availability', compact('isAvailable', 'startDate', 'endDate', 'formattedStartDate', 'formattedEndDate', 'with_driver', 'pickup', 'vehicle', 'vehicle_type', 'user'));
    }
    

    public function showBookingForm(Request $request, $vehicle_type, $vehicle_id)
    {
        $user = Auth::user();
        $request->validate([
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'with_driver' => 'required|boolean',
            'pickup' => 'required|in:Ambil Sendiri,Diantar Sesuai Alamat',
        ]);

        $vehicle = $this->getVehicleByType($vehicle_type, $vehicle_id);

        $startDate = $request->start_date;
        $endDate = $request->end_date;
        $formattedStartDate = Carbon::parse($startDate)->translatedFormat('j F Y');
        $formattedEndDate = Carbon::parse($endDate)->translatedFormat('j F Y');

        $daysCount = (new \DateTime($endDate))->diff(new \DateTime($startDate))->days + 1;
        $bookingFeePerDay = $vehicle->price;
        $bookingFee = $daysCount * $bookingFeePerDay;
        $with_driver = $request->with_driver;
        $pickup = $request->pickup;
        $driver = Driver::first();

        $driverFee = $with_driver ? ($daysCount * $driver->biaya_driver) : 0;
        $totalFee = $bookingFee + $driverFee;

        return view('frontend.vehicle.booking_form', compact(
            'vehicle',
            'vehicle_type',
            'user',
            'startDate',
            'endDate',
            'formattedStartDate',
            'formattedEndDate',
            'daysCount',
            'bookingFee',
            'with_driver',
            'pickup',
            'driverFee',
            'totalFee'
        ));
    }

    public function bookVehicle(Request $request, $vehicle_type, $vehicle_id)
    {
        $user = Auth::user();

        if (!$user) {
            return redirect()->route('login')->with('error', 'Silakan login terlebih dahulu.');
        }

        $vehicle = $this->getVehicleByType($vehicle_type, $vehicle_id);
        $startDate = Carbon::parse($request->start_date)->format('Y-m-d');
        $endDate = Carbon::parse($request->end_date)->format('Y-m-d');
        $daysCount = (new \DateTime($endDate))->diff(new \DateTime($startDate))->days + 1;
        $bookingFeePerDay = $vehicle->price;
        $bookingFee = $daysCount * $bookingFeePerDay;

        $with_driver = $request->with_driver;
        $pickup = $request->pickup;
        $driver = Driver::first();

        $driverFee = $with_driver ? ($daysCount * $driver->biaya_driver) : 0;
        $totalFee = $bookingFee + $driverFee;

        $bookingCode = strtoupper(Str::random(5));

        $booking = Booking::create([
            'vehicle_type' => $vehicle_type,
            'vehicle_id' => $vehicle_id,
            'user_id' => $user->id,
            'start_date' => $startDate,
            'end_date' => $endDate,
            'days_count' => $daysCount,
            'booking_fee' => $bookingFee,
            'with_driver' => $with_driver,
            'pickup' => $pickup,
            'driver_fee' => $driverFee,
            'total_fee' => $totalFee,
            'booking_status' => 'Menunggu Pembayaran',
            'booking_code' => $bookingCode,
        ]);

        return redirect()->route('booking_confirmation', ['booking_code' => $bookingCode, 'vehicle_type' => $vehicle_type, 'vehicle_id' => $vehicle_id]);
    }

    public function showBookingConfirmation($booking_code)
    {
        $this->cancelExpiredBookings(); // Call to cancel expired bookings

        $user = Auth::user();
        $booking = Booking::where('booking_code', $booking_code)->with('user', 'cancellation')->firstOrFail();

        // Ensure the booking belongs to the logged-in user
        if (Gate::denies('view', $booking) && !$user->is_admin) {
            return redirect()->route('homepage')->with([
                'message' => 'Anda tidak memiliki akses ke pemesanan ini.',
                'alert-type' => 'error',
            ]);
        }

        $feedbacks = Feedback::where('booking_code', $booking_code)->get();
        $vehicle = $booking->vehicle_type == 'car' ? Car::find($booking->vehicle_id) : Motorcycle::find($booking->vehicle_id);

        // Set your Merchant Server Key
        \Midtrans\Config::$serverKey = config('midtrans.serverKey');
        \Midtrans\Config::$isProduction = false;
        \Midtrans\Config::$isSanitized = true;
        \Midtrans\Config::$is3ds = true;

        // Populate transaction details
        $params = [
            'transaction_details' => [
                'order_id' => rand(),
                'gross_amount' => $booking->total_fee,
            ],
            'customer_details' => [
                'first_name' => $booking->user->name,
                'email' => $booking->user->email,
                'phone' => $booking->user->phone,
            ],
        ];

        $snapToken = \Midtrans\Snap::getSnapToken($params);
        $booking->snap_token = $snapToken;
        $booking->save();

        // session()->flash('message', 'Pemesanan berhasil! Silakan lakukan pembayaran.');
        // session()->flash('alert-type', 'success');

        return view('frontend.vehicle.booking_confirmation', compact('booking', 'vehicle', 'feedbacks', 'user'));
    }


    public function showDetails($booking_code)
    {
        $this->cancelExpiredBookings(); // Call to cancel expired bookings

        $user = Auth::user();
        $booking = Booking::where('booking_code', $booking_code)->with('user', 'cancellation')->firstOrFail();
        if (Gate::denies('view', $booking) && !$user->is_admin) {
            return redirect()->route('homepage')->with([
                'message' => 'Anda tidak memiliki akses ke pemesanan ini.',
                'alert-type' => 'error',
            ]);
        }

        $feedbacks = Feedback::where('booking_code', $booking_code)->get();

        $booking = Booking::where('booking_code', $booking_code)->firstOrFail();
        return view('frontend.vehicle.booking_confirmation', compact('booking', 'feedbacks', 'user'));

        return view('frontend.vehicle.booking_confirmation', compact('booking', 'feedbacks', 'user', 'snapToken', 'vehicle'));
    }

    private function getVehicleByType($vehicle_type, $vehicle_id)
    {
        $user = Auth::user();
        if ($vehicle_type == 'car') {
            return Car::findOrFail($vehicle_id);
        } elseif ($vehicle_type == 'motorcycle') {
            return Motorcycle::findOrFail($vehicle_id);
        } else {
            throw new \Exception('Invalid vehicle type');
        }
    }

    public function showBookingSuccess($booking_code)
    {
        $user = Auth::user();
        $booking = Booking::where('booking_code', $booking_code)->firstOrFail();

        // Ensure the booking belongs to the logged-in user
        if (Gate::denies('view', $booking) && !$user->is_admin) {
            return redirect()->route('homepage')->with('error', 'Anda tidak memiliki akses ke pemesanan ini.');
        }

        $booking->booking_status = 'Pembayaran Terkonfirmasi';
        $booking->save();

        $userHasGivenFeedback = Feedback::where('user_id', $user->id)
            ->where('booking_code', $booking_code)
            ->exists();

        return view('frontend.vehicle.booking_success', compact('booking', 'userHasGivenFeedback', 'user'));
    }

    private function cancelExpiredBookings()
    {
        $now = Carbon::now();
        $expiredBookings = Booking::where('booking_status', 'Menunggu Pembayaran')
            ->where('created_at', '<=', $now->subHours(24))
            ->get();

        foreach ($expiredBookings as $booking) {
            $booking->update(['booking_status' => 'Dibatalkan']);
        }
    }

    public function cancelBooking(Request $request)
    {
        $request->validate([
            'booking_code' => 'required|exists:bookings,booking_code',
            'reason' => 'required|string',
        ]);

        $user = Auth::user();

        // Find the booking
        $booking = Booking::where('booking_code', $request->booking_code)->firstOrFail();

        // Handle cancellation data
        $cancellationData = [
            'booking_code' => $request->booking_code,
            'user_id' => $user->id,
            'vehicle_name' => $request->vehicle_name,
            'reason' => $request->reason,
        ];

        // Check and update the booking status
        if ($booking->booking_status == 'Pembayaran Terkonfirmasi') {

            $request->validate([
                'refund_account' => 'required|string',
                'proof_payment' => 'required|file|mimes:jpeg,png,jpg,gif,svg,pdf',
            ]);

            if ($request->hasFile('proof_payment')) {
                $proofPaymentPath = $request->file('proof_payment')->store('proof_payments', 'public');
                $cancellationData['proof_payment'] = $proofPaymentPath;
            }

            $cancellationData['refund_account'] = $request->refund_account;

            $booking->update(['booking_status' => 'Menunggu Konfirmasi']);

        } elseif ($booking->booking_status == 'Menunggu Pembayaran') {

            $request->validate([
                'refund_account' => 'nullable|string',
                'proof_payment' => 'nullable|file|mimes:jpeg,png,jpg,gif,svg,pdf',
            ]);

            Cancellation::create($cancellationData);

            $booking->update(['booking_status' => 'Dibatalkan']);
            return redirect()->back()->with([
                'message' => 'Booking berhasil dibatalkan!',
                'alert-type' => 'success'
            ]);
        }

        // Save the cancellation
        Cancellation::create($cancellationData);

        return redirect()->back()->with([
            'message' => 'Permintaan pembatalan booking telah dikirim!',
            'alert-type' => 'success'
        ]);
    }
}