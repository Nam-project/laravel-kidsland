<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $table = "products";

    public function subcategory()
    {
        return $this->belongsTo(SubCategory::class,'subcategory_id');
    }

    public function DetailOrder()
    {
        return $this->hasMany(DetailOrder::class);
    }

}
