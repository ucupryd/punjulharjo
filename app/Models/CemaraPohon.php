<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CemaraPohon extends Model
{
    protected $fillable = [
        'kode_pohon',
        'adopsi_id',
        'user_id',
        'nama_sertifikat',
        'jenis',
        'tanggal_tanam',
        'lat',
        'lng',
        'lokasi_teks',
        'status',
    ];

    protected $casts = [
        'tanggal_tanam' => 'date',
    ];

    public function adopsi()
    {
        return $this->belongsTo(CemaraAdopsi::class, 'adopsi_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function monitorings()
    {
        return $this->hasMany(CemaraMonitoring::class, 'pohon_id');
    }
}
