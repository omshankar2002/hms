<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookingService extends Model
{
    use HasFactory;

    protected $fillable = [
        'booking_id', 'hotel_service_id', 'quantity', 'unit_price', 'total_price', 'notes'
    ];

    public function booking()
    {
        return $this->belongsTo(Booking::class);
    }

    public function hotelService()
    {
        return $this->belongsTo(HotelService::class);
    }
}
