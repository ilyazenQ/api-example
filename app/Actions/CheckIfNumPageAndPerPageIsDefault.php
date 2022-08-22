<?php

namespace App\Actions;

use App\Models\Post;
use Illuminate\Support\Facades\Cache;

class CheckIfNumPageAndPerPageIsDefault implements Action
{
    public function execute(array $fields)
    {
        $fields['page'] = $fields['page'] ?? Post::PAGE_DEFAULT;
        $fields['per_page'] = $fields['per_page'] ?? Post::PER_PAGE_DEFAULT;

        if($fields['page'] != Post::PAGE_DEFAULT || $fields['per_page'] != Post::PER_PAGE_DEFAULT) {
            $fields['is_default'] = false;
            Cache::forget(Post::CACHE_KEY_NAME_FOR_ALL);
        } else {
            $fields['is_default'] = true;
        }

        return $fields;
    }
}
