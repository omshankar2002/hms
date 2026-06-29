<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    // Add this relationship
    public function products()
    {
        return $this->hasMany(Product::class)->where('status', 1);
    }

    public function sub_category()
    {
        return $this->hasMany(SubCategory::class)->where('status', 1);
    }

    public function blogs()
    {
        return $this->hasMany(Blog::class);
    }

}   
