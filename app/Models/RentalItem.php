<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

#[Fillable([
    'rental_id',
    'alat_id',
    'jumlah',
    'harga_saat_sewa',
])]

class RentalItem extends Model
{
    use HasFactory;

public function rental()
{
    return $this->belongsTo(Rental::class);
}

public function alat()
{
    return $this->belongsTo(Alat::class);
}
}
