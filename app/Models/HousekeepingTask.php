<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HousekeepingTask extends Model
{
    use HasFactory;

    protected $fillable = [
        'room_id', 'assigned_to', 'task_type', 'priority',
        'status', 'notes', 'scheduled_date', 'completed_at'
    ];

    protected $casts = [
        'scheduled_date' => 'date',
        'completed_at'   => 'datetime',
    ];

    public function room()
    {
        return $this->belongsTo(Room::class);
    }
}
