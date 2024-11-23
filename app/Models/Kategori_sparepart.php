<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kategori_sparepart extends Model
{
    //
    public function sparepart()
    {
        return $this->hasMany(Sparepart::class, 'kategori_id');
    }
}
