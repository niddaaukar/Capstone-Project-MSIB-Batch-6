<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Booking;
use Illuminate\Support\Facades\Auth;

class HistoryController extends Controller
{
    //
    public function index()
    {
        $user = Auth::user();
        $bookings = Booking::where('user_id', $user->id)
        ->orderBy('created_at', 'desc')
        ->get();

        return view('frontend.history.index', compact('user', 'bookings'));
    }

}
