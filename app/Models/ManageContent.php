<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ManageContent extends Model
{
    // Specify the table if it's not the default 'manage_contents'
    protected $table = 'manage_contents';

    // Specify the fillable fields
    protected $fillable = ['title', 'description', 'image'];
}