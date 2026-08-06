<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TimProklim extends Model
{
    protected $table = 'tim_proklims';

    protected $fillable = [
        'nama',
        'peran',
        'foto',
        'urutan',
    ];
}
