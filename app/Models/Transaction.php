<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'transaction_number',
        'transaction_type',
        'status',
        'from_wallet',
        'to_wallet',
        'txid',
        'amount',
        'remark',
        'approved_at',
    ];
}
