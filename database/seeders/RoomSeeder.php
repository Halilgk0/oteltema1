<?php

namespace Database\Seeders;

use App\Models\Room;
use App\Models\RoomType;
use Illuminate\Database\Seeder;

class RoomSeeder extends Seeder
{
    /**
     * Create a handful of physical rooms for every room type,
     * spread across floors and mostly available for booking.
     */
    public function run()
    {
        $statusPool = [
            'available', 'available', 'available', 'available',
            'occupied', 'maintenance',
        ];

        RoomType::all()->each(function (RoomType $roomType, int $typeIndex) use ($statusPool) {
            $floor = $typeIndex + 1;
            $roomsPerType = 5;

            for ($i = 1; $i <= $roomsPerType; $i++) {
                $roomNumber = sprintf('%d%02d', $floor, $i);

                Room::firstOrCreate(
                    ['room_number' => $roomNumber],
                    [
                        'room_type_id' => $roomType->id,
                        'status' => $statusPool[array_rand($statusPool)],
                        'description' => "{$roomType->name} - Floor {$floor}",
                        'is_clean' => (bool) random_int(0, 4), // mostly clean
                    ]
                );
            }
        });
    }
}
