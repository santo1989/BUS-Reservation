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
}

