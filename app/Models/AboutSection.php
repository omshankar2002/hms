<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AboutSection extends Model
{
    protected $fillable = [
    'heading', 'sub_heading', 'description', 'features', 'image', 'video_url'
    ];
    protected $casts = [
        'features' => 'array',
    ];

}
