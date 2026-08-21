<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PantaiKarangJaheSorotan extends Model
{
    protected $table = 'pantai_karang_jahe_sorotans';

    protected $fillable = [
        'judul',
        'deskripsi',
        'icon',
        'gambar',
        'urutan',
    ];
}
