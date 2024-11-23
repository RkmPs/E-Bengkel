<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kendaraan extends Model
{

    //
    public function customer()
    {
        return $this->belongsTo(User::class, 'customer_id');
    }

    public function transaksi()
    {
        return $this->hasMany(Transaksi::class, 'kendaraan_id');
    }
}
