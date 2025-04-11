<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookingTable extends Model
{
    use HasFactory;

    protected $table = 'booking_table';

    protected $fillable = [
        'user_id',
        'table_id',
        'booking_date',
        'time_slot',
        'status',
    ];

    public function table()
    {
        return $this->belongsTo(Table::class, 'table_id');
    }
}
