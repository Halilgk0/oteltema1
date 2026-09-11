<?php

namespace App\Http\Controllers;

use App\Models\Room;
use App\Models\RoomType;
use App\Models\Booking;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class BookingController extends Controller
{
    public function create(RoomType $roomType)
    {
        return view('bookings.create', compact('roomType'));
    }

    public function store(Request $request, RoomType $roomType)
    {
        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'check_in' => 'required|date|after:today',
            'check_out' => 'required|date|after:check_in',
            'number_of_guests' => 'required|integer|min:1|max:' . $roomType->capacity,
            'special_requests' => 'nullable|string'
        ]);

        try {
            DB::beginTransaction();

            // Use the logged-in account, or find/create a guest account by email
            $customer = auth()->user() ?? User::firstOrCreate(
                ['email' => $validated['email']],
                [
                    'name' => trim($validated['first_name'] . ' ' . $validated['last_name']),
                    'phone' => $validated['phone'],
                    'password' => Hash::make(Str::random(32))
                ]
            );

            // Find available room
            $room = Room::where('room_type_id', $roomType->id)
                ->where('status', 'available')
                ->first();

            if (!$room) {
                throw new \Exception('No rooms available for the selected type.');
            }

            // Calculate total price
            $checkIn = \Carbon\Carbon::parse($validated['check_in']);
            $checkOut = \Carbon\Carbon::parse($validated['check_out']);
            $numberOfNights = $checkIn->diffInDays($checkOut);
            $totalPrice = $roomType->base_price * $numberOfNights;

            // Create booking
            $booking = Booking::create([
                'customer_id' => $customer->id,
                'room_id' => $room->id,
                'check_in' => $validated['check_in'],
                'check_out' => $validated['check_out'],
                'number_of_guests' => $validated['number_of_guests'],
                'total_price' => $totalPrice,
                'special_requests' => $validated['special_requests'],
                'status' => 'pending'
            ]);

            DB::commit();

            return redirect()->route('bookings.confirmation', $booking)
                ->with('success', 'Booking created successfully!');

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withInput()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function confirmation(Booking $booking)
    {
        return view('bookings.confirmation', compact('booking'));
    }

    public function cancel(Booking $booking)
    {
        abort_unless($booking->customer_id === auth()->id(), 403);

        if (!in_array($booking->status, ['pending', 'confirmed']) || $booking->check_in->isPast()) {
            return back()->withErrors(['error' => 'Bu rezervasyon iptal edilemez.']);
        }

        $booking->delete();

        return back()->with('success', 'Rezervasyonunuz iptal edildi.');
    }
}
