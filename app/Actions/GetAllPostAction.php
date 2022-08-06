<?php

namespace App\Actions;

use App\Models\Post;
use App\Queries\PostQuery;
use Illuminate\Support\Facades\Cache;

class GetAllPostAction implements Action
{
    public function execute(PostQuery $query, array $fields)
    {
        $fields = (new CheckIfNumPageAndPerPageIsDefault())->execute($fields);

        if ($fields['is_default']) {
            return (new CacheAllPostAction())->execute($query,$fields);
        } else {
            return $query->paginate($fields['per_page'], ['*'], 'page', $fields['page']);
        }
    }
}
