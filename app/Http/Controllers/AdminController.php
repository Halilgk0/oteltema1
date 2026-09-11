<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RoomType;
use App\Models\Room;
use App\Models\Booking;
use App\Models\Amenity;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    private $adminPassword = 'admin123'; // Güvenlik için daha sonra .env'ye taşınabilir

    public function showLogin()
    {
        if (session('is_admin')) {
            return redirect()->route('admin.dashboard');
        }
        return view('admin.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'password' => 'required'
        ]);

        if ($request->password === 'admin123') {
            session(['is_admin' => true]);
            return redirect()->route('admin.dashboard');
        }

        return back()->with('error', 'Şifre hatalı!');
    }

    public function dashboard()
    {
        $stats = [
            'total_rooms' => RoomType::count(),
            'total_bookings' => Booking::count(),
            'recent_bookings' => Booking::with(['customer', 'room.roomType'])
                ->orderBy('created_at', 'desc')
                ->take(5)
                ->get()
        ];

        return view('admin.dashboard', compact('stats'));
    }

    public function rooms()
    {
        $roomTypes = RoomType::with(['amenities', 'rooms'])->get();
        return view('admin.rooms', compact('roomTypes'));
    }

    // Yeni Oda Tipi Ekleme Formu
    public function createRoomType()
    {
        $amenities = Amenity::all();
        return view('admin.room-types.create', compact('amenities'));
    }

    // Yeni Oda Tipi Kaydetme
    public function storeRoomType(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'capacity' => 'required|integer|min:1',
            'base_price' => 'required|numeric|min:0',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'amenities' => 'array',
            'amenities.*' => 'exists:amenities,id'
        ]);

        $imagePath = $request->file('image')->store('room-types', 'public');
        
        $roomType = RoomType::create([
            'name' => $validated['name'],
            'description' => $validated['description'],
            'capacity' => $validated['capacity'],
            'base_price' => $validated['base_price'],
            'image' => Storage::url($imagePath)
        ]);

        if (isset($validated['amenities'])) {
            $roomType->amenities()->attach($validated['amenities']);
        }

        return redirect()->route('admin.rooms')->with('success', 'Oda tipi başarıyla oluşturuldu.');
    }

    // Oda Tipi Düzenleme Formu
    public function editRoomType(RoomType $roomType)
    {
        $amenities = Amenity::all();
        return view('admin.room-types.edit', compact('roomType', 'amenities'));
    }

    // Oda Tipi Güncelleme
    public function updateRoomType(Request $request, RoomType $roomType)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'capacity' => 'required|integer|min:1',
            'base_price' => 'required|numeric|min:0',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'amenities' => 'array',
            'amenities.*' => 'exists:amenities,id'
        ]);

        if ($request->hasFile('image')) {
            // Delete old image
            if ($roomType->image) {
                Storage::delete(str_replace('/storage/', 'public/', $roomType->image));
            }
            
            $imagePath = $request->file('image')->store('room-types', 'public');
            $validated['image'] = Storage::url($imagePath);
        }

        $roomType->update($validated);

        if (isset($validated['amenities'])) {
            $roomType->amenities()->sync($validated['amenities']);
        }

        return redirect()->route('admin.rooms')->with('success', 'Oda tipi başarıyla güncellendi.');
    }

    // Oda Tipi Silme
    public function deleteRoomType(RoomType $roomType)
    {
        if ($roomType->rooms()->exists()) {
            return back()->with('error', 'Bu oda tipine ait odalar bulunduğu için silinemez.');
        }

        if ($roomType->image) {
            Storage::delete(str_replace('/storage/', 'public/', $roomType->image));
        }

        $roomType->amenities()->detach();
        $roomType->delete();

        return redirect()->route('admin.rooms')->with('success', 'Oda tipi başarıyla silindi.');
    }

    // Yeni Oda Ekleme Formu
    public function createRoom()
    {
        $roomTypes = RoomType::all();
        return view('admin.rooms.create', compact('roomTypes'));
    }

    // Yeni Oda Kaydetme
    public function storeRoom(Request $request)
    {
        $validated = $request->validate([
            'room_number' => 'required|string|max:255|unique:rooms',
            'room_type_id' => 'required|exists:room_types,id',
            'status' => 'required|in:available,occupied,maintenance',
            'is_clean' => 'required|boolean'
        ]);

        Room::create($validated);

        return redirect()->route('admin.rooms')->with('success', 'Oda başarıyla oluşturuldu.');
    }

    // Oda Düzenleme Formu
    public function editRoom(Room $room)
    {
        $roomTypes = RoomType::all();
        return view('admin.rooms.edit', compact('room', 'roomTypes'));
    }

    // Oda Güncelleme
    public function updateRoom(Request $request, Room $room)
    {
        $validated = $request->validate([
            'room_number' => 'required|string|max:255|unique:rooms,room_number,' . $room->id,
            'room_type_id' => 'required|exists:room_types,id',
            'status' => 'required|in:available,occupied,maintenance',
            'is_clean' => 'required|boolean'
        ]);

        $room->update($validated);

        return redirect()->route('admin.rooms')->with('success', 'Oda başarıyla güncellendi.');
    }

    // Oda Silme
    public function deleteRoom(Room $room)
    {
        if ($room->bookings()->exists()) {
            return back()->with('error', 'Bu odaya ait rezervasyonlar bulunduğu için silinemez.');
        }

        $room->delete();

        return redirect()->route('admin.rooms')->with('success', 'Oda başarıyla silindi.');
    }

    public function bookings()
    {
        $stats = [
            'total_bookings' => Booking::count(),
            'confirmed_bookings' => Booking::where('status', 'confirmed')->count(),
            'pending_bookings' => Booking::where('status', 'pending')->count(),
            'cancelled_bookings' => Booking::where('status', 'cancelled')->count(),
        ];

        $bookings = Booking::with(['customer', 'room.roomType'])
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('admin.bookings', compact('stats', 'bookings'));
    }

    public function events()
    {
        return view('admin.events');
    }

    public function logout()
    {
        session()->forget('is_admin');
        auth()->logout();
        return redirect()->route('home');
    }

    public function index()
    {
        $stats = [
            'total_rooms' => RoomType::count(),
            'total_bookings' => Booking::count(),
            'recent_bookings' => Booking::with(['customer', 'room.roomType'])
                ->orderBy('created_at', 'desc')
                ->take(5)
                ->get()
        ];

        return view('admin.dashboard', compact('stats'));
    }
} 