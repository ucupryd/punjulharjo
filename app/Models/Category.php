<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
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

    public function blogs(): BelongsToMany
    {
        return $this->belongsToMany(Blog::class);
    }

    public function badgeClasses(): string
    {
        return match ($this->color) {
            'brand-dark' => 'bg-brand-dark/10 text-brand-dark ring-brand-dark/20',
            'brand-accent' => 'bg-brand-accent/15 text-brand-dark ring-brand-accent/30',
            'brand-light' => 'bg-brand-light/20 text-brand-dark ring-brand-light/30',
            'sky' => 'bg-sky-50 text-sky-700 ring-sky-200',
            'emerald' => 'bg-emerald-50 text-emerald-700 ring-emerald-200',
            'amber' => 'bg-amber-50 text-amber-800 ring-amber-200',
            'rose' => 'bg-rose-50 text-rose-700 ring-rose-200',
            default => 'bg-slate-100 text-slate-700 ring-slate-200',
        };
    }
}
