<?php

namespace App\Models;

use App\Elastic\Traits\Searchable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    use Searchable;

    const CACHE_TIME = 3600;
    const CACHE_KEY_NAME_FOR_ALL = 'posts';
    const FILLABLE = ['title', 'slug', 'body', 'user_id', 'is_published'];

    /**
     * @var array
     */
    protected $fillable = self::FILLABLE;

}
