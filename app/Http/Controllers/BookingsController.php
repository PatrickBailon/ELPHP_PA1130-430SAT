<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BookingsController extends Controller
{
    public function index()
    {
        $this->authorize('viewAny', Bookings::class);
        return response()->json(Bookings::all());
    }

    public function store(Request $request)
    {
        $request->validate([
            'vehicles_id' => 'required|exists:vehicles,vehicles_id',
            'pickup_date' => 'required|date',
            'return_date' => 'required|date|after:pickup_date',
            'total_price' => 'required|numeric',
            'status' => 'required|string',
        ]);

        $booking = Bookings::create([
            'users_id' => Auth::id(),
            'vehicles_id' => $request->vehicles_id,
            'pickup_date' => $request->pickup_date,
            'return_date' => $request->return_date,
            'total_price' => $request->total_price,
            'status' => $request->status,
        ]);

        return response()->json($booking, 201);
    }

    public function update(Request $request, $id)
    {
        $booking = Bookings::findOrFail($id);

        // Only owner of the vehicle can update status
        $this->authorize('update', $booking);

        $request->validate([
            'status' => 'required|string',
        ]);

        $booking->update(['status' => $request->status]);

        return response()->json($booking);
    }

    public function destroy($id)
    {
        $booking = Bookings::findOrFail($id);

        // Only renter can cancel their own booking
        $this->authorize('delete', $booking);

        $booking->delete();

        return response()->json(['message' => 'Booking cancelled successfully']);
    }
}
