<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HistoryChart extends Model
{
    use HasFactory;

    protected function casts(): array
    {
        return [
            'Date' => 'timestamp',
            'local_date' => 'timestamp',
        ];
    }
}
