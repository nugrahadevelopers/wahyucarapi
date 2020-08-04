<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Mobil extends Model
{
    // protected $fillable = [
    //     'nama_mobil', 'harga_mobil', 'tipe_mobil', 'merek_mobil', 'varian_mobil', 'tahun_mobil', 'mesin_mobil',
    //     'warna_mobil', 'kapasitas_mobil'
    // ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
