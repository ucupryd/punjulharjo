<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

class Ebook extends Model
{
    protected $fillable = ['title', 'description', 'pdf_path', 'cover_path'];

    protected static function booted(): void
    {
        static::deleting(function ($ebook) {
            $ebook->featured()->delete();
            $ebook->categories()->detach();
            \App\Models\Comment::where('commentable_type', get_class($ebook))
                               ->where('commentable_id', $ebook->id)
                               ->delete();
            $ebook->reactions()->delete();
        });
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

    public function viewLogs()
    {
        return $this->morphMany(\App\Models\ViewLog::class, 'viewable');
    }
}
