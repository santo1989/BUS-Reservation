<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Trip extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function bus()
    {
        return $this->belongsTo(Bus::class);
    }

    public function event()
    {
        return $this->belongsTo(Event::class);
    }

    public function driver()
    {
        return $this->belongsTo(Driver::class);
    }

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }

    public function passengers()
    {
        return $this->hasMany(Passenger::class);
    }

    public function buses()
    {
        return $this->belongsToMany(Bus::class);
    }

    public function events()
    {
        return $this->belongsToMany(Event::class);
    }

    public function drivers()
    {
        return $this->belongsToMany(Driver::class);
    }

    
}

