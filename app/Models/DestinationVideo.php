<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DestinationVideo extends Model
{
    use HasFactory;

    protected $fillable = [
        'judul',
        'caption',
        'video',
        'urutan',
        'aktif'
    ];

    protected $casts = [
        'aktif' => 'boolean',
        'urutan' => 'integer'
    ];

    /**
     * Scope to only include active videos.
     */
    public function scopeActive($query)
    {
        return $query->where('aktif', true);
    }

    /**
     * Scope to order videos by order sequence.
     */
    public function scopeOrdered($query)
    {
        return $query->orderBy('urutan', 'asc');
    }
}
