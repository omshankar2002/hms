<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    // ✅ Add this fillable array:
    protected $fillable = [
        'subtotal',
        'shipping',
        'grand_total',
        'discount',
        'coupon_code_id',
        'coupon_code',
        'payment_status',
        'status',
        'user_id',
        'first_name',
        'last_name',
        'email',
        'mobile',
        'country_id',
        'address',
        'apartment',
        'city',
        'state',
        'zip',
        'notes',
    ];

   public function items()
{
    return $this->hasMany(OrderItem::class, 'order_id');
}
}
