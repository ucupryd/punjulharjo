<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Video extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'description',
        'video_url',
        'thumbnail',
        'user_id'
    ];

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($video) {
            $video->slug = Str::slug($video->title);
        });
    }

    public function author()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
