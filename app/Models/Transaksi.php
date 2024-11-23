<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    //
    public function customer()
    {
        return $this->belongsTo(User::class, 'customer_id');
    }

    public function kendaraan()
    {
        return $this->belongsTo(Kendaraan::class, 'kendaraan_id');
    }

    public function admin()
    {
        return $this->belongsTo(Admin::class, 'admin_id');
    }

    public function detailTransaksi()
    {
        return $this->hasMany(Detail_transaksi::class, 'transaksi_id');
    }
}
