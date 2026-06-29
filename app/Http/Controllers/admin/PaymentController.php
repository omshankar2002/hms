<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Payment;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function index(Request $request)
    {
        $query = Payment::with('booking.guest');

        if ($request->filled('method')) {
            $query->where('method', $request->method);
        }
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $payments = $query->latest()->paginate(20);
        return view('admin.payments.index', compact('payments'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'booking_id'     => 'required|exists:bookings,id',
            'amount'         => 'required|numeric|min:0.01',
            'method'         => 'required|in:cash,card,upi,bank_transfer,online',
            'transaction_id' => 'nullable|string',
            'notes'          => 'nullable|string',
        ]);

        $booking = Booking::findOrFail($request->booking_id);

        Payment::create([
            'booking_id'     => $booking->id,
            'amount'         => $request->amount,
            'method'         => $request->method,
            'transaction_id' => $request->transaction_id,
            'status'         => 'completed',
            'notes'          => $request->notes,
            'paid_at'        => now(),
        ]);

        $booking->recalculateTotals();

        return back()->with('success', 'Payment of ₹' . number_format($request->amount, 2) . ' recorded successfully.');
    }

    public function destroy(Payment $payment)
    {
        $booking = $payment->booking;
        $payment->delete();
        $booking->recalculateTotals();

        return back()->with('success', 'Payment deleted.');
    }
}
