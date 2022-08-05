<?php

namespace App\Actions;

use App\Models\Post;
use Illuminate\Support\Arr;

class PatchPostAction
{
    public function execute(int $id, array $fields): Post
    {
        $post = Post::findOrFail($id);
        $post->update(Arr::only($fields, Post::FILLABLE));
        return $post;
    }
}
