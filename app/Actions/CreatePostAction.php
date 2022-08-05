<?php

namespace App\Actions;

use App\Models\Post;
use Illuminate\Support\Arr;

class CreatePostAction
{
    public function execute(array $fields): Post
    {
        (new ClearCacheWhenCreateAndDeleteAction())->execute();
        return Post::create(Arr::only($fields, Post::FILLABLE));
    }

}
