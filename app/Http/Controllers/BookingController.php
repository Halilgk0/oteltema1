<?php

namespace App\Http\Controllers;

use App\Models\Room;
use App\Models\RoomType;
use App\Models\Booking;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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

            // Create or update customer
            $customer = Customer::firstOrCreate(
                ['email' => $validated['email']],
                [
                    'first_name' => $validated['first_name'],
                    'last_name' => $validated['last_name'],
                    'phone' => $validated['phone']
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
}
