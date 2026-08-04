<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class FeaturedItem extends Model
{
    protected $fillable = ['featurable_type', 'featurable_id', 'position'];

    public function featurable(): MorphTo
    {
        return $this->morphTo();
    }
}
