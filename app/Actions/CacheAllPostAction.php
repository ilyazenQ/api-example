<?php

namespace App\Actions;

use App\Models\Post;
use App\Queries\PostQuery;
use Illuminate\Support\Facades\Cache;

class CacheAllPostAction implements Action
{
    public function execute(PostQuery $query, array $fields)
    {
        return Cache::remember(Post::CACHE_KEY_NAME_FOR_ALL, Post::CACHE_TIME,
            function () use ($query,$fields) {
                return $query->paginate( Post::PER_PAGE_DEFAULT, ['*'], 'page', Post::PAGE_DEFAULT);
            });
    }

}
