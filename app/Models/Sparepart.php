<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sparepart extends Model
{
    //
    public function kategori()
    {
        return $this->belongsTo(Kategori_sparepart::class, 'kategori_id', 'kategori_id');
    }

    public function detailTransaksi()
    {
        return $this->hasMany(Detail_transaksi::class, 'sparepart_id', 'sparepart_id');
    }
}
