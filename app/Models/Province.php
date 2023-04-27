<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Province extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $fillable = [
        'name','type','matp'
    ];
    protected $primaryKey = 'maqh';
    protected $table = "devvn_quanhuyen";

    public function city()
    {
        return $this->belongsTo(City::class,'matp');
    }
}
