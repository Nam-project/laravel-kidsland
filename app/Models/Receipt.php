<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Receipt extends Model
{
    use HasFactory;

    protected $table = "receipts";

    public function supplier()
    {
        return $this->belongsTo(Supplier::class,'suppliers_id');
    }
    public function warehouse()
    {
        return $this->belongsTo(WareHouse::class,'warehouse_id');
    }

    public function detailReceipt()
    {
        return $this->hasMany(DetailReceipt::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
