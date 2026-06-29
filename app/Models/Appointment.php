<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model {
    protected $fillable = ['name', 'email', 'phone', 'service', 'message', 'contact_time'];
    protected $casts = ['contact_time' => 'array'];
}