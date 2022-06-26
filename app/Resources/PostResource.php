<?php

namespace App\Resources;

use App\Models\Post;
use App\Support\Resources\BaseJsonResource;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin Post */
class PostResource extends BaseJsonResource
{
    /**
     * Transform the resource collection into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'data' => [
                'id' => $this->id,
                'title' => $this->title,
                'slug' => $this->slug,
                'body' => $this->body,
                'user_id' => $this->user_id,
                'is_published' => $this->is_published,
                'created_at' => $this->created_at,
                'updated_at' => $this->updated_at,
            ],
            "meta" => []
        ];
    }
}

