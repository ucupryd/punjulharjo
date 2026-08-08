<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Illuminate\Support\Str;

class Blog extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'content',
        'image',
        'user_id',
        'published_at',
    ];

    // Buat slug otomatis dari title
    public static function boot()
    {
        parent::boot();
        static::creating(function ($blog) {
            $blog->slug = Str::slug($blog->title);
        });
        static::deleting(function ($blog) {
            $blog->featured()->delete();
            $blog->categories()->detach();
            \App\Models\Comment::where('commentable_type', get_class($blog))
                               ->where('commentable_id', $blog->id)
                               ->delete();
            $blog->reactions()->delete();
        });
    }

    public function author(): BelongsTo
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

    public function getAutoExcerptAttribute(): string
    {
        return Str::limit(strip_tags($this->content ?? ''), 50, '…');
    }
}
