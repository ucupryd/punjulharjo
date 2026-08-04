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
}
