<?php

namespace App\Actions;

use App\Models\Post;
use Illuminate\Support\Arr;

class CreatePostAction implements Action
{
    public function execute(array $fields): Post
    {
        return Post::create(Arr::only($fields, Post::FILLABLE));
    }

}
