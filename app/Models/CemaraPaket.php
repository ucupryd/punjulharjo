<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CemaraPaket extends Model
{
    protected $fillable = [
        'kode',
        'nama',
        'deskripsi',
        'jenis_pohon',
        'jumlah_bibit',
        'harga',
        'bonus',
        'aktif',
    ];

    protected $casts = [
        'aktif' => 'boolean',
    ];

    public function adopsis()
    {
        return $this->hasMany(CemaraAdopsi::class, 'paket_id');
    }
}
