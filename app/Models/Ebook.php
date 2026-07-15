<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ebook extends Model
{
    protected $fillable = ['title', 'description', 'pdf_path', 'cover_path'];
}
