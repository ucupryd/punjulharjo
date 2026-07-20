<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CemaraAdopsi extends Model
{
    protected $fillable = [
        'kode_transaksi',
        'user_id',
        'paket_id',
        'nama_pemesan',
        'nama_sertifikat',
        'telepon',
        'jumlah',
        'total_harga',
        'metode_bayar',
        'bukti_bayar',
        'status',
        'catatan_admin',
        'dibayar_at',
        'diverifikasi_at',
    ];

    protected $casts = [
        'dibayar_at' => 'datetime',
        'diverifikasi_at' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function paket()
    {
        return $this->belongsTo(CemaraPaket::class, 'paket_id');
    }

    public function pohons()
    {
        return $this->hasMany(CemaraPohon::class, 'adopsi_id');
    }
}
