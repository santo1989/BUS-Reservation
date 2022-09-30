<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    protected $table = 'bookings';
    protected $guarded = [];

    public function passenger()
    {
        return $this->belongsTo(Passenger::class);
    }

    public function trip()
    {
        return $this->belongsTo(Trip::class);
    }
}
