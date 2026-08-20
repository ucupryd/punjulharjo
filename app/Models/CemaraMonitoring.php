<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CemaraMonitoring extends Model
{
    protected $fillable = [
        'pohon_id',
        'tanggal',
        'tinggi_cm',
        'jumlah_daun',
        'perkiraan_tinggi',
        'kondisi_daun',
        'cabang_baru',
        'kerusakan',
        'nama_petugas',
        'tindakan_bibit_mati',
        'foto',
        'catatan',
    ];

    protected $casts = [
        'tanggal' => 'date',
    ];

    public function pohon()
    {
        return $this->belongsTo(CemaraPohon::class, 'pohon_id');
    }
}
