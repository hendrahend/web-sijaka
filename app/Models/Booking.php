<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'nip', 'car_id', 'sopir_id', 'tanggal_pinjam', 'selesai_pinjam', 'kegiatan', 'catatan', 'status'
    ];

    public function car()
    {
        return $this->belongsTo(Car::class, 'car_id', 'id');
    }

    public function sopir()
    {
        return $this->belongsTo(Sopir::class, 'sopir_id', 'id');
    }
}
