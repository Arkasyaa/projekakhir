<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

#[Fillable([
    'user_id',
    'booking_code',
    'tanggal_pengambilan',
    'durasi_sewa',
    'tanggal_kembali',
    'total_pembayaran',
    'status',
    'catatan',
])]

class Rental extends Model
{
    use HasFactory;

public function user()
{
    return $this->belongsTo(User::class);
}

public function items()
{
    return $this->hasMany(RentalItem::class);
}
}
