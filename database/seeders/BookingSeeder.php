<?php

namespace Database\Seeders;

use App\Models\Booking;
use App\Models\Room;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class BookingSeeder extends Seeder
{
    /**
     * Create a set of guest accounts and a mix of past, current,
     * upcoming and cancelled bookings so the admin dashboard and
     * "my bookings" page have something realistic to show.
     */
    public function run()
    {
        $guests = [
            ['name' => 'Elif Yıldız', 'email' => 'elif.yildiz@example.com'],
            ['name' => 'Mehmet Demir', 'email' => 'mehmet.demir@example.com'],
            ['name' => 'Ayşe Kaya', 'email' => 'ayse.kaya@example.com'],
            ['name' => 'John Carter', 'email' => 'john.carter@example.com'],
            ['name' => 'Sophie Martin', 'email' => 'sophie.martin@example.com'],
            ['name' => 'Ahmet Şahin', 'email' => 'ahmet.sahin@example.com'],
        ];

        $customers = collect($guests)->map(function (array $guest) {
            return User::firstOrCreate(
                ['email' => $guest['email']],
                [
                    'name' => $guest['name'],
                    'phone' => '+90 5' . random_int(30, 59) . random_int(1000000, 9999999),
                    'password' => Hash::make(Str::random(32)),
                ]
            );
        });

        $rooms = Room::with('roomType')->get();

        if ($rooms->isEmpty() || $customers->isEmpty()) {
            return;
        }

        // [status, offset in days for check-in, length of stay in nights]
        $bookingPlan = [
            ['status' => 'checked_out', 'checkInOffset' => -14, 'nights' => 3],
            ['status' => 'checked_out', 'checkInOffset' => -7, 'nights' => 2],
            ['status' => 'checked_in', 'checkInOffset' => -1, 'nights' => 4],
            ['status' => 'confirmed', 'checkInOffset' => 3, 'nights' => 2],
            ['status' => 'confirmed', 'checkInOffset' => 10, 'nights' => 5],
            ['status' => 'pending', 'checkInOffset' => 20, 'nights' => 3],
            ['status' => 'pending', 'checkInOffset' => 30, 'nights' => 1],
            ['status' => 'cancelled', 'checkInOffset' => 15, 'nights' => 2],
        ];

        foreach ($bookingPlan as $index => $plan) {
            $room = $rooms[$index % $rooms->count()];
            $customer = $customers[$index % $customers->count()];

            $checkIn = Carbon::now()->addDays($plan['checkInOffset'])->setTime(14, 0);
            $checkOut = (clone $checkIn)->addDays($plan['nights']);

            Booking::firstOrCreate(
                [
                    'customer_id' => $customer->id,
                    'room_id' => $room->id,
                    'check_in' => $checkIn,
                ],
                [
                    'check_out' => $checkOut,
                    'number_of_guests' => random_int(1, max(1, $room->roomType->capacity)),
                    'total_price' => $plan['nights'] * $room->roomType->base_price,
                    'status' => $plan['status'],
                    'special_requests' => $index % 3 === 0 ? 'Late check-in requested.' : null,
                ]
            );
        }
    }
}
