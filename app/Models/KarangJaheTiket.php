<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KarangJaheTiket extends Model
{
    protected $table = 'karang_jahe_tikets';

    protected $fillable = [
        'komponen',
        'tarif',
        'catatan',
        'ikon',
        'urutan',
    ];
}
