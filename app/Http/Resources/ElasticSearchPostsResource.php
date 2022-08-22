<?php

namespace App\Http\Resources;

use Illuminate\Contracts\Support\Responsable;

class ElasticSearchPostsResource implements Responsable
{
    public function __construct(
        private array $posts
    ) {
    }

    public function toResponse($request)
    {
        return response()->json(['data' => $this->posts]);
    }
}

