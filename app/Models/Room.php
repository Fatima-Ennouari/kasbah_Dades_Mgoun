<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    protected $fillable = [
        'name', 'type', 'price', 'description', 'image',
        'capacity', 'view', 'has_balcony', 'has_ac', 'available'
    ];

    protected $casts = [
        'has_balcony' => 'boolean',
        'has_ac'      => 'boolean',
        'available'   => 'boolean',
    ];

    // one room can have many reservations
    public function reservations()
    {
        return $this->hasMany(Reservation::class);
    }

    // helper to get french type label
    public function getTypeLabelAttribute(): string
    {
        return match($this->type) {
            'single' => 'Chambre Simple',
            'double' => 'Chambre Double',
            'family' => 'Chambre Familiale',
            'suite'  => 'Suite',
            default  => $this->type,
        };
    }

    // helper to get french view label
    public function getViewLabelAttribute(): string
    {
        return match($this->view) {
            'river'    => 'Vue Rivière',
            'garden'   => 'Vue Jardin',
            'mountain' => 'Vue Montagne',
            'pool'     => 'Vue Piscine',
            default    => $this->view ?? '',
        };
    }
}