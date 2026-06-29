<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SocialLink extends Model
{
    use HasFactory;

    // Specify the table name if not plural of model name
    protected $table = 'social_links';

    // Define which fields are mass assignable
    protected $fillable = [
        'phone', 'gmail', 'address', 'google',
        'facebook', 'twitter', 'instagram', 'linkedin', 'youtube'
    ];
    
}
