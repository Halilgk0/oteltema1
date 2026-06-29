<?php

namespace App\Http\Controllers;

use App\Models\Room;
use App\Models\RoomType;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $featuredRoomTypes = RoomType::with('amenities')->take(3)->get();
        $allRoomTypes = RoomType::with('amenities')->get();
        return view('home', compact('featuredRoomTypes', 'allRoomTypes'));
    }

    public function contact()
    {
        return view('contact');
    }
}
