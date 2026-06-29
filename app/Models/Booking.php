<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    protected $fillable = [
        'booking_number', 'guest_id', 'room_id', 'check_in', 'check_out',
        'adults', 'children', 'room_rate', 'nights', 'room_total',
        'services_total', 'discount', 'tax', 'grand_total',
        'amount_paid', 'amount_due', 'status', 'payment_status',
        'source', 'special_requests', 'notes'
    ];

    protected $casts = [
        'check_in'  => 'date',
        'check_out' => 'date',
    ];

    public function guest()
    {
        return $this->belongsTo(Guest::class);
    }

    public function room()
    {
        return $this->belongsTo(Room::class);
    }

    public function bookingServices()
    {
        return $this->hasMany(BookingService::class);
    }

    public function payments()
    {
        return $this->hasMany(Payment::class);
    }

    public static function generateBookingNumber(): string
    {
        $prefix = 'BK';
        $number = str_pad(self::max('id') + 1, 6, '0', STR_PAD_LEFT);
        return $prefix . date('Ymd') . $number;
    }

    public function recalculateTotals(): void
    {
        $this->room_total     = $this->room_rate * $this->nights;
        $this->services_total = $this->bookingServices()->sum('total_price');
        $subtotal             = $this->room_total + $this->services_total - $this->discount;
        $this->tax            = round($subtotal * 0.12, 2); // 12% GST
        $this->grand_total    = $subtotal + $this->tax;
        $this->amount_paid    = $this->payments()->where('status', 'completed')->sum('amount');
        $this->amount_due     = $this->grand_total - $this->amount_paid;

        if ($this->amount_paid >= $this->grand_total) {
            $this->payment_status = 'paid';
        } elseif ($this->amount_paid > 0) {
            $this->payment_status = 'partial';
        } else {
            $this->payment_status = 'unpaid';
        }

        $this->saveQuietly();
    }
}
