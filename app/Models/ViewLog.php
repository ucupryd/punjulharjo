<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class ViewLog extends Model
{
    use HasFactory;

    protected $fillable = [
        'viewable_type',
        'viewable_id',
        'visitor_token'
    ];

    /**
     * Get the parent viewable model (Blog, Video, or Ebook).
     */
    public function viewable(): MorphTo
    {
        return $this->morphTo();
    }
}
