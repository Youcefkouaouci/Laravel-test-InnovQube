<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookingController extends Controller
{
    use AuthorizesRequests;
    public function index()
    {
        $bookings = Auth::user()->bookings()
            // $bookings = Booking::where('user_id', Auth::id())
            ->with('property')
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('bookings.index', compact('bookings'));
    }

    public function show(Booking $booking)
    {
        $this->authorize('view', $booking);
        return view('bookings.show', compact('booking'));
    }

    public function cancel(Booking $booking)
    {
        $this->authorize('update', $booking);

        if ($booking->status === 'cancelled') {
            return back()->with('error', 'Cette réservation est déjà annulée.');
        }

        $booking->update(['status' => 'cancelled']);

        return back()->with('success', 'Votre réservation a été annulée.');
    }
}
