<?php

namespace App\Actions;

use App\Models\Post;
use Illuminate\Support\Facades\Cache;

class ClearCacheWhenCreateAndDeleteAction
{
    public function execute()
    {
        if(Cache::has(Post::CACHE_KEY_NAME_FOR_ALL)) {
            Cache::forget(Post::CACHE_KEY_NAME_FOR_ALL);
        }
    }

}
