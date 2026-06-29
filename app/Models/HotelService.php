<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HotelService extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'category', 'description', 'price', 'unit', 'status'
    ];

    public function bookingServices()
    {
        return $this->hasMany(BookingService::class);
    }
}
