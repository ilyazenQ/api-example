<?php

namespace App\Service\CacheService\Post;


use App\Models\Post;
use App\Queries\PostQuery;
use Illuminate\Support\Facades\Cache;

class CachePost
{
    public function cacheAll(PostQuery $query, array $fields)
    {
        return Cache::remember(Post::CACHE_KEY_NAME_FOR_ALL, Post::CACHE_TIME,
            function () use ($query,$fields) {
                return $query->paginate( Post::PER_PAGE_DEFAULT, ['*'], 'page', Post::PAGE_DEFAULT);
            });
    }

    public function ClearPostsCache()
    {
        if(Cache::has(Post::CACHE_KEY_NAME_FOR_ALL)) {
            Cache::forget(Post::CACHE_KEY_NAME_FOR_ALL);
        }
    }
}
