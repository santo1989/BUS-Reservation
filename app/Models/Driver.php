<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Driver extends Model
{
    use HasFactory;
    protected $guarded = [];


    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function passenger()
    {
        return $this->belongsToMany(Passenger::class);
    }

    public function trip()
    {
        return $this->belongsToMany(Trip::class);
    }

    public function bus()
    {
        return $this->belongsToMany(Bus::class);
    }

    public function event()
    {
        return $this->belongsToMany(Event::class);
    }

    public function passengers()
    {
        return $this->hasMany(Passenger::class);
    }
}
