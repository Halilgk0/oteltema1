<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [HomeController::class, 'index'])->name('home');

// Rooms Routes
Route::get('/rooms', [RoomController::class, 'index'])->name('rooms');
Route::get('/rooms/{roomType}', [RoomController::class, 'show'])->name('rooms.show');

Route::get('/events', [EventController::class, 'index'])->name('events.index');

// Auth Routes
Route::get('/giris', [AuthController::class, 'showLogin'])->name('login');
// throttle:<name> limits are defined in RouteServiceProvider; extra requests get a 429 response.
// Login also locks a single email after 5 wrong passwords (see AuthController::login).
Route::post('/giris', [AuthController::class, 'login'])->middleware('throttle:login')->name('login.post');
Route::get('/kayit', [AuthController::class, 'showRegister'])->name('register');
Route::post('/kayit', [AuthController::class, 'register'])->middleware('throttle:register')->name('register.post');
Route::post('/cikis', [AuthController::class, 'logout'])->name('logout');

// Protected Routes
Route::middleware(['auth'])->group(function () {
    Route::get('/book/{roomType}', [BookingController::class, 'create'])->name('bookings.create');
    Route::post('/book/{roomType}', [BookingController::class, 'store'])->middleware('throttle:bookings')->name('bookings.store');
    Route::get('/booking/confirmation/{booking}', [BookingController::class, 'confirmation'])->name('bookings.confirmation');
    Route::get('/profil', [AuthController::class, 'profile'])->name('profile');
    Route::post('/profil/sifre', [AuthController::class, 'updatePassword'])->middleware('throttle:password')->name('profile.password');
    Route::get('/rezervasyonlarim', [AuthController::class, 'myBookings'])->name('my-bookings');
    Route::post('/rezervasyonlarim/{booking}/iptal', [BookingController::class, 'cancel'])->middleware('throttle:bookings')->name('bookings.cancel');
});

// Admin Routes — admins sign in through the regular login page; everyone else gets a 404.
Route::middleware(['admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::redirect('/', '/admin/dashboard')->name('index');
    Route::get('/dashboard', [AdminController::class, 'index'])->name('dashboard');
    Route::get('/rooms', [AdminController::class, 'rooms'])->name('rooms');
    Route::get('/bookings', [AdminController::class, 'bookings'])->name('bookings');
    
    // Room Types Routes
    Route::get('/room-types/create', [AdminController::class, 'createRoomType'])->name('room-types.create');
    Route::post('/room-types', [AdminController::class, 'storeRoomType'])->name('room-types.store');
    Route::get('/room-types/{roomType}/edit', [AdminController::class, 'editRoomType'])->name('room-types.edit');
    Route::put('/room-types/{roomType}', [AdminController::class, 'updateRoomType'])->name('room-types.update');
    Route::delete('/room-types/{roomType}', [AdminController::class, 'deleteRoomType'])->name('room-types.delete');
    
    // Rooms Routes
    Route::get('/rooms/create', [AdminController::class, 'createRoom'])->name('rooms.create');
    Route::post('/rooms', [AdminController::class, 'storeRoom'])->name('rooms.store');
    Route::get('/rooms/{room}/edit', [AdminController::class, 'editRoom'])->name('rooms.edit');
    Route::put('/rooms/{room}', [AdminController::class, 'updateRoom'])->name('rooms.update');
    Route::delete('/rooms/{room}', [AdminController::class, 'deleteRoom'])->name('rooms.delete');
});

// Contact Route
Route::get('/contact', [HomeController::class, 'contact'])->name('contact');
