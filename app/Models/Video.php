<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
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
        static::deleting(function ($video) {
            $video->featured()->delete();
            $video->categories()->detach();
            \App\Models\Comment::where('commentable_type', get_class($video))
                               ->where('commentable_id', $video->id)
                               ->delete();
            $video->reactions()->delete();
        });
    }

    public function author()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function categories(): MorphToMany
    {
        return $this->morphToMany(Category::class, 'categorizable');
    }

    public function featured(): \Illuminate\Database\Eloquent\Relations\MorphOne
    {
        return $this->morphOne(\App\Models\FeaturedItem::class, 'featurable');
    }

    public function comments()
    {
        return $this->morphMany(\App\Models\Comment::class, 'commentable')->whereNull('parent_id')->latest();
    }

    public function reactions()
    {
        return $this->morphMany(\App\Models\Reaction::class, 'reactable');
    }
}
