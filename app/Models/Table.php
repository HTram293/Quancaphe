<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Table extends Model
{
    use HasFactory;

    protected $table = 'tables';

    protected $fillable = [
        'table_number',
        'table_type',
        'position',
        'status',
        'seating_capacity',
        'description'
    ];

    public function bookings()
    {
        return $this->hasMany(BookingTable::class, 'table_id');
    }
}
