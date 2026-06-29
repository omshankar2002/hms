<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShippingCharge extends Model
{
    use HasFactory;
    public function getAmountAttribute($value) {
        return $value ?? 0; // Null case handle करें
    }
}
