<?php

namespace App\Actions;

use App\Models\Post;

class DeletePostAction implements Action
{
    public function execute(int $id): void
    {
        $post = Post::findOrFail($id);
        $post::destroy($post->id);
    }

}
