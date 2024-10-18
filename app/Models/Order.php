<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'order_id',
        'symbol',
        'type',
        'volume',
        'price',
        'open_time',
        'close_time',
        'status',
        'profit',
        'close_price',
    ];
}
