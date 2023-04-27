<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $table = "orders";

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function detailOrder()
    {
        return $this->hasMany(DetailOrder::class);
    }

    public function transaction()
    {
        return $this->hasOne(Transaction::class);
    }

    public function ward()
    {
        return $this->belongsTo(Wards::class,'ward_id');
    }
}
