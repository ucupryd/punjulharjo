<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Reaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'reactable_type',
        'reactable_id',
        'type',
        'visitor_token'
    ];

    /**
     * Get the parent reactable model (Blog, Video, or Ebook).
     */
    public function reactable(): MorphTo
    {
        return $this->morphTo();
    }
}
