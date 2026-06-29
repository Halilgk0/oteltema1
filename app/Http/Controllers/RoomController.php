<?php

namespace App\Http\Controllers;

use App\Models\Room;
use App\Models\RoomType;
use Illuminate\Http\Request;

class RoomController extends Controller
{
    public function index()
    {
        $roomTypes = RoomType::with('amenities')->get();
        return view('rooms.index', compact('roomTypes'));
    }

    public function show(RoomType $roomType)
    {
        $roomType->load('amenities');
        $availableRooms = Room::where('room_type_id', $roomType->id)
            ->where('status', 'available')
            ->count();
            
        return view('rooms.show', compact('roomType', 'availableRooms'));
    }
}
