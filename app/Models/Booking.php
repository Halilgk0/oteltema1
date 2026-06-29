<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_id',
        'room_id',
        'check_in',
        'check_out',
        'number_of_guests',
        'total_price',
        'status',
        'special_requests'
    ];

    protected $dates = [
        'check_in',
        'check_out'
    ];

    public function customer()
    {
        return $this->belongsTo(User::class, 'customer_id');
    }

    public function room()
    {
        return $this->belongsTo(Room::class);
    }

    public function getDurationAttribute()
    {
        return $this->check_in->diffInDays($this->check_out);
    }

    public function calculateTotalPrice()
    {
        $duration = $this->duration;
        $basePrice = $this->room->roomType->base_price;
        return $duration * $basePrice;
    }
}
