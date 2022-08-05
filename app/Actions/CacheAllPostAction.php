<?php

namespace App\Actions;

use App\Models\Post;
use App\Queries\PostQuery;
use Illuminate\Support\Facades\Cache;

class CacheAllPostAction
{
    public function execute(PostQuery $query)
    {
        return Cache::remember(Post::CACHE_KEY_NAME_FOR_ALL, Post::CACHE_TIME,
            function () use ($query) {
                return $query->paginate();
            });
    }

}
