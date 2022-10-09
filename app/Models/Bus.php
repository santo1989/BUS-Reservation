<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bus extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function trip()
    {
        return $this->belongsToMany(Trip::class);
    }

    public function booking()
    {
        return $this->hasMany(Booking::class);
    }

    public function event()
    {
        return $this->belongsToMany(Event::class);
    }

    public function driver()
    {
        return $this->belongsToMany(Driver::class);
    }

    public function trips()
    {
        return $this->belongsToMany(Trip::class);
    }

    public function bookings()
    {
        return $this->belongsToMany(Booking::class);
    }

    public function events()
    {
        return $this->belongsToMany(Event::class);
    }   

    


}
