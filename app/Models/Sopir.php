<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sopir extends Model
 {
    use HasFactory;

    protected $fillable = [
        'name', 'no_wa', 'status'
    ];

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }
}
    
