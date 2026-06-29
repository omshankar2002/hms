<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Guest extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'email', 'phone', 'id_type', 'id_number',
        'nationality', 'address', 'city', 'country', 'dob', 'gender'
    ];

    protected $casts = [
        'dob' => 'date',
    ];

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }

    public function activeBooking()
    {
        return $this->hasOne(Booking::class)->whereIn('status', ['confirmed', 'checked_in']);
    }
}
