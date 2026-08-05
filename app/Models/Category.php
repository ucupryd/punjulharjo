<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Illuminate\Support\Str;

class Category extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'icon',
        'color',
        'description',
    ];

    protected static function boot(): void
    {
        parent::boot();

        static::creating(function (Category $category) {
            if (empty($category->slug)) {
                $category->slug = Str::slug($category->name);
            }
        });

        static::updating(function (Category $category) {
            if ($category->isDirty('name') && ! $category->isDirty('slug')) {
                $category->slug = Str::slug($category->name);
            }
        });
    }

    public function blogs(): MorphToMany
    {
        return $this->morphedByMany(Blog::class, 'categorizable');
    }

    public function videos(): MorphToMany
    {
        return $this->morphedByMany(Video::class, 'categorizable');
    }

    public function ebooks(): MorphToMany
    {
        return $this->morphedByMany(Ebook::class, 'categorizable');
    }

    public function badgeClasses(): string
    {
        return match ($this->color) {
            'brand-dark' => 'text-brand-dark border border-brand-dark/20',
            'brand-accent' => 'text-brand-dark border border-brand-accent/30',
            'brand-light' => 'text-brand-dark border border-brand-light/30',
            'sky' => 'text-sky-700 border border-sky-200',
            'emerald' => 'text-emerald-700 border border-emerald-200',
            'amber' => 'text-amber-800 border border-amber-200',
            'rose' => 'text-rose-700 border border-rose-200',
            default => 'text-slate-700 border border-slate-200',
        };
    }
}
