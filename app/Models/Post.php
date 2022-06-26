<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    const FILLABLE = ['title', 'slug', 'body', 'user_id', 'is_published'];

    /**
     * @var array
     */
    protected $fillable = self::FILLABLE;

}
