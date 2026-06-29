<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\RoomType;
use App\Models\Amenity;

class RoomTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Create amenities
        $amenities = [
            ['name' => 'Free Wi-Fi', 'icon' => '<i class="fas fa-wifi"></i>'],
            ['name' => 'Air Conditioning', 'icon' => '<i class="fas fa-snowflake"></i>'],
            ['name' => 'Mini Bar', 'icon' => '<i class="fas fa-glass-martini-alt"></i>'],
            ['name' => 'Room Service', 'icon' => '<i class="fas fa-concierge-bell"></i>'],
            ['name' => 'Flat-screen TV', 'icon' => '<i class="fas fa-tv"></i>'],
            ['name' => 'Ocean View', 'icon' => '<i class="fas fa-water"></i>'],
            ['name' => 'Private Balcony', 'icon' => '<i class="fas fa-door-open"></i>'],
            ['name' => 'King Size Bed', 'icon' => '<i class="fas fa-bed"></i>']
        ];

        foreach ($amenities as $amenity) {
            Amenity::create($amenity);
        }

        // Create room types
        $roomTypes = [
            [
                'name' => 'Deluxe Ocean Suite',
                'description' => 'Experience luxury with our spacious ocean-view suite featuring a private balcony, king-size bed, and premium amenities. Perfect for couples seeking a romantic getaway.',
                'base_price' => 450.00,
                'capacity' => 2,
                'image' => 'https://images.unsplash.com/photo-1582719478250-c89cae4dc85b?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=2070&q=80'
            ],
            [
                'name' => 'Family Comfort Room',
                'description' => 'Spacious family room with two queen beds, entertainment center, and a cozy sitting area. Ideal for families or small groups traveling together.',
                'base_price' => 350.00,
                'capacity' => 4,
                'image' => 'https://images.unsplash.com/photo-1591088398332-8a7791972843?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=2074&q=80'
            ],
            [
                'name' => 'Presidential Suite',
                'description' => 'The epitome of luxury with panoramic ocean views, separate living and dining areas, premium furnishings, and exclusive services. Experience the very best of luxury hospitality.',
                'base_price' => 800.00,
                'capacity' => 3,
                'image' => 'https://images.unsplash.com/photo-1631049307264-da0ec9d70304?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=2070&q=80'
            ]
        ];

        foreach ($roomTypes as $roomType) {
            $type = RoomType::create($roomType);
            
            // Attach random amenities to each room type
            $amenityIds = Amenity::inRandomOrder()->take(5)->pluck('id');
            $type->amenities()->attach($amenityIds);
        }
    }
}
