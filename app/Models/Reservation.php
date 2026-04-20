<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    protected $fillable = [
        'client_name', 'client_email', 'client_phone',
        'room_id', 'check_in', 'check_out',
        'num_people', 'notes', 'status'
    ];

    protected $casts = [
        'check_in'  => 'date',
        'check_out' => 'date',
    ];

    public function room()
    {
        return $this->belongsTo(Room::class);
    }

    // calculate number of nights
    public function getNightsAttribute(): int
    {
        return $this->check_in->diffInDays($this->check_out);
    }

    // calculate total cost
    public function getTotalAttribute(): float
    {
        return $this->nights * ($this->room->price ?? 0);
    }
}