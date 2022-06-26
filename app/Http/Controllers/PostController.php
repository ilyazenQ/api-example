<?php

namespace App\Http\Controllers;

use App\Actions\CreatePostAction;
use App\Models\Post;
use App\Requests\CreatePostRequest;
use App\Resources\PostResource;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function create(CreatePostRequest $request, CreatePostAction $action)
    {
        return new PostResource($action->execute($request->validated()));
    }
}
