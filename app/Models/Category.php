<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $table = "categories";

    public function brand()
    {
        return $this->hasMany(Brand::class);
    }

    public function subcategory()
    {
        return $this->hasMany(SubCategory::class);
    }

    public function weightAge()
    {
        return $this->hasMany(WeightAge::class);
    }
    
}
