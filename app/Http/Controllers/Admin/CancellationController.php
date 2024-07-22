<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Cancellation;
use App\Models\Booking;

class CancellationController extends Controller
{
    //
    public function index()
    {
        $cancellations = Cancellation::with('user', 'booking')
        ->orderBy('created_at', 'desc')
        ->get();
        return view('admin.cancellations.index', compact('cancellations'));
    }

    public function show($id)
    {
        $cancellation = Cancellation::findOrFail($id);
        return view('admin.cancellations.show', compact('cancellation'));
    }

    public function edit ($id)
    {
        $cancellation = Cancellation::findOrFail($id);
        return view('admin.cancellations.edit', compact('cancellation'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'booking_code' => 'required',
            'refund_proof' => 'required|file|mimes:jpeg,png,jpg,gif,svg,pdf',
        ]);

        $cancellation = Cancellation::findOrFail($id);
        $refundProofPath = $request->file('refund_proof')->store('refund_proofs', 'public');
        $cancellation->update(['refund_proof' => $refundProofPath]);

        $booking = Booking::where('booking_code', $request->booking_code)->firstOrFail();
        $booking->update(['booking_status' => 'Dibatalkan']);

        return redirect()->route('admin.cancellations.index')->with([
            'message' => 'Data pembatalan berhasil diperbarui!',
            'alert-type' => 'success'
        ]);
    }

    public function destroy($id)
    {
        $cancellation = Cancellation::findOrFail($id);
        $cancellation->delete();
        return redirect()->route('admin.cancellations.index')->with([
            'message' => 'Data pembatalan berhasil dihapus!',
            'alert-type' => 'success'
        ]);
    }
}
