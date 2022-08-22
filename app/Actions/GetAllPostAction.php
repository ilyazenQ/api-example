<?php

namespace App\Actions;

use App\Models\Post;
use App\Queries\PostQuery;
use App\Service\CacheService\Post\CachePost;
use Illuminate\Support\Facades\Cache;

class GetAllPostAction implements Action
{
    public function execute(PostQuery $query, array $fields)
    {
        $fields = (new CheckIfNumPageAndPerPageIsDefault())->execute($fields);

        if ($fields['is_default']) {
            return (new CachePost())->cacheAll($query,$fields);
        } else {
            return $query->paginate($fields['per_page'], ['*'], 'page', $fields['page']);
        }
    }
}
