<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Event extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $guarded = [];

    public function trips()
    {
        return $this->hasMany(Trip::class);
    }

    public function buses()
    {
        return $this->belongsToMany(Bus::class);
    }

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }

    public function drivers()
    {
        return $this->belongsToMany(Driver::class);
    }

    public function passengers()
    {
        return $this->belongsToMany(Passenger::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    

}
